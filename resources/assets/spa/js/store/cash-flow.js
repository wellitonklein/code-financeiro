import {CashFlow} from '../services/resources'
import moment from 'moment'

const state = {
    cashFlows: null,
    firstMonthYear: null,
}

const mutations = {
    set(state,cashFlows){
        state.cashFlows = cashFlows
    },
    setFirstMonthYear(state, date){
        state.firstMonthYear = moment(date).startOf('day').subtract(1,'months').format('YYYY-MM')
    }
}

const actions = {
    query(context){
        return CashFlow.query().then((response) => {
            context.commit('set', response.data)
        })
    },
}

const getters = {
    indexSecoundMonth(state, getters){
        return getters.hasFirstMonthYear ? 1 : 0
    },
    filterMonthYear: (state) => (monthYear) => {
        if (state.cashFlows.hasOwnProperty('months_list')){
            return state.cashFlows.months_list.filter((item) => {
                return item.month_year === monthYear
            })
        }

        return []
    },
    hasFirstMonthYear(state, getters){
        return getters.filterMonthYear(state.firstMonthYear).length > 0
    },
    firstBalance(state, getters){
        let balanceBeforeFirstMonth = state.cashFlows.balance_before_first_month
        let balanceFirstMonth = 0

        if (getters.hasFirstMonthYear){
            let firstMonthYear = getters.filterMonthYear(state.firstMonthYear)
            balanceFirstMonth = firstMonthYear[0].revenues.total - firstMonthYear[0].expenses.total
        }
        return balanceBeforeFirstMonth + balanceFirstMonth
    },
    secoundBalance(state, getters){
        let firstBalance = getters.firstBalance
        let indexSecoundMonth = getters.indexSecoundMonth
        let secoundMonthYear = state.cashFlows.months_list[indexSecoundMonth].month_year
        let secoundMonthObj = getters.filterMonthYear(secoundMonthYear)[0]

        return firstBalance + secoundMonthObj.revenues.total - secoundMonthObj.expenses.total
    },
    monthsListBalanceFinal(state, getters){
        let monthsListLength = state.cashFlows.months_list

        return monthsListLength.slice(getters.indexSecoundMonth+1,monthsListLength.length)
    },
    hasCashFlows(sate){
        return state.cashFlows !== null && state.cashFlows.months_list.length > 1
    },
    balance: (state, getters) => (index) => {
        return getters._calculateBalance(index+getters.indexSecoundMonth + 1)
    },
    _calculateBalance: (state, getters) => (index) => {
        let indexSecoundMonth = getters.indexSecoundMonth
        let previousIndex = index-1
        let previousBalance = 0

        switch (previousIndex) {
            case 0:
                //primeiro mes: Jan
                //segundo mes: Fev
                previousBalance = indexSecoundMonth === 0 ? getters.secoundBalance : getters.firstBalance;
                break
            case 1:
                previousBalance = indexSecoundMonth === 1 ? getters.secoundBalance : getters._calculateBalance(previousIndex);
                break
            default:
                previousBalance = getters._calculateBalance(previousIndex)
        }

        let monthYear = state.cashFlows.months_list[index].month_year
        let monthObj = getters.filterMonthYear(monthYear)[0]

        return previousBalance + monthObj.revenues.total - monthObj.expenses.total
    },
    // mapBankAccounts: (state, getters) => (name) => {
    //     let bankAccounts = getters.filterBankAccountByName(name)
    //     return bankAccounts.map((o) => {
    //         return {id: o.id, text: getters.textAutoComplete(o)}
    //     })
    // },
    // textAutoComplete: (state) => (bankAccount) => {
    //     return `${bankAccount.name} - ${bankAccount.account}`
    // }
}

const module = {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}

export default module