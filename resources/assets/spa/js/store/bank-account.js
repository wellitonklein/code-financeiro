import {BankAccount} from '../services/resources'
import SearchOptions from '../services/search-options'

const state = {
    bankAccounts: [],
    bankAccountDelete: null,
    searchOptions: new SearchOptions(),
}

const mutations = {
    set(state,bankAccounts){
        state.bankAccounts = bankAccounts
    },
    setDelete(state, bankAccount){
        state.bankAccountDelete = bankAccount
    },
    'delete'(state){
        state.bankAccount.$remove(state.bankAccountDelete)
    },
    setOrder(state,key){
        state.searchOptions.order.key = key
    },
    setPagination(state, pagination){
        state.searchOptions.pagination = pagination
    },
    setCurrentPage(state,currentPage){
        state.searchOptions.pagination.current_page = currentPage
    },
    setFilter(state, filter){
        state.searchOptions.search = filter
    }
}

const actions = {
    query(context, {pagination, order, search}){
        return BankAccount.query({
            page: pagination.current_page+1,
            orderBy: order.key,
            sortBy: order.sort,
            search: search,
            include: 'bank'
        }).then((response) => {
            context.commit('set',response.data.data)
            context.commit('setPagination',response.data.meta.pagination)
        })
    },
    queryWithSortBy(context,key){
        context.commit('setOrder', key)
        context.dispatch('query')
    },
    queryWithPagination(context, currentPage){
        context.commit('setCurrentPage', currentPage)
        context.dispatch('query')
    },
    queryWithFilter(context){
        context.dispatch('query')
    }
}

const module = {
    state,
    mutations,
    actions
}

export default module