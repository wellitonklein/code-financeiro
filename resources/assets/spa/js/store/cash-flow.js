import {CashFlow} from '../services/resources'
import moment from 'moment'

const state = {
    cashFlows: [],
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
    filterMonthYear: (state) => (monthYear) => {
        if (state.cashFlows.hasOwnProperty('months_list')){
            return state.cashFlows.months_list.filter((item) => {
                return item.month_year == monthYear
            })
        }

        return []
    },
    hasFirstMonthYear(state, getters){
        return getters.filterMonthYear(state.firstMonthYear).length > 0
    }
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