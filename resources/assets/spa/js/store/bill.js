import SearchOptions from '../services/search-options'

export default () => {

    const include = 'category,bankAccount'
    const state = {
        bills: [],
        billData: {
            total_paid: 0,
            total_to_pay: 0,
            total_expired: 0,
        },
        billDelete: null,
        resource: null,
        searchOptions: new SearchOptions(include)
    }

    const mutations = {
        set(state,bills){
            state.bills = bills
        },
        setBillData(state,billData){
            state.billData = billData
        },
        update(state, {index, bill}){
            state.bills.$set(index, bill)
        },
        'setDelete'(state, bill){
            state.billDelete = bill
        },
        'delete'(state){
            state.bills.$remove(state.billDelete)
        },
        setOrder(state, key){
            state.searchOptions.order.key = key
            let sort = state.searchOptions.order.sort
            state.searchOptions.order.sort = sort === 'desc' ? 'asc' : 'desc'
        },
        setPagination(state, pagination){
            state.searchOptions.pagination = pagination
        },
        setCurrentPage(state, currentPage){
            state.searchOptions.pagination.current_page = currentPage
        },
        setFilter(state, filter){
            state.searchOptions.search = filter
        }
    }

    const actions = {
        query(context){
            let searchOptions = context.state.searchOptions
            return context.state.resource.query(searchOptions.createOptions()).then((response) => {
                context.commit('set', response.data.bills.data)
                context.commit('setPagination', response.data.bills)
                context.commit('setBillData', response.data.bill_data)
            })
        },
        queryWidthSortBy(context, key){
            context.commit('setOrder', key)
            context.dispatch('query')
        },
        queryWidthPagination(context, currentPage){
            context.commit('setCurrentPage', currentPage)
            context.dispatch('query')
        },
        queryWidthFilter(context){
            context.dispatch('query')
        },
        'delete'(context){
            let id = context.state.billDelete.id
            return context.state.resource.delete({id: id}).then((response) => {
                context.commit('delete')
                context.commit('setDelete',null)

                let bills = context.state.bills
                let pagination = context.state.searchOptions.pagination
                if (bills.length === 0 && pagination.current_page > 0){
                    context.commit('setCurrentPage', pagination.current_page--)
                }
                return response
            })
        },
        save(context, bill){
            return context.state.resource.save({}, bill.toJSON()).then((response) => {
                context.dispatch('query')
                return response
            })
        },
        edit(context, {index, bill}){
            return context.state.resource.update({id: bill.id, include: include}, bill.toJSON()).then((response) => {
                context.commit('update',{index, bill: response.data.data})
                return response
            })
        }
    }

    const getters = {
        billByIndex: (state) => (index) => {
            return state.bills[index]
        }
    }

    const module = {
        namespaced: true,
        state,
        mutations,
        actions,
        getters
    }

    return module

}