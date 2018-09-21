import {CashFlow} from '../services/resources'
import _ from "lodash";

const state = {
    cashFlows: [],
}

const mutations = {
    set(state,cashFlows){
        state.cashFlows = cashFlows
    },
}

const actions = {
    query(context){
        return CashFlow.query().then((response) => {
            context.commit('set', response.data)
        })
    },
}

const getters = {
    // filterBankAccountByName: (state) => (name) => {
    //     let bankAccounts = _.filter(state.lists, (o) => {
    //         return _.includes(o.name.toLowerCase(), name.toLowerCase())
    //     })
    //     return bankAccounts
    // },
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