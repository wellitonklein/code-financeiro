export default class  {
    constructor(include = null){
        this.pagination = {
            current_page: 0,
            per_page: 0,
            total:0
        }

        this.search = ''
        this.order = {
            get key(){
                return this._key
            },
            set key(value){
                this._key = value
                this.sort = this.sort == 'desc' ? 'asc' : 'desc'
            },
            _key: 'id',
            sort: 'asc'
        }
        this.include = include
    }

    get pagination(){
        return this._pagination
    }

    set pagination(value){
        value.current_page--
        this._pagination = value
    }

    createOptions(){
        let options = {
            page: this.pagination.current_page+1,
            orderBy: this.order.key,
            sortBy: this.order.sort,
            search: this.search
        }
        
        if (this.include){
            options.include = this.include
        }

        return options
    }
}