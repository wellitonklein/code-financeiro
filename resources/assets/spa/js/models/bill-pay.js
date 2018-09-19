export default class BillPay {
    constructor(data = {}){
        this.init()
        Object.assign(this, data)
    }

    init(){
        this.id = 0
        this.date_due = new Date()
        this.name = ''
        this.value = 0
        this.done = false
        this.bank_account_id = ''
        this.category_id = 0
        this.repeat = false
        this.repeat_type = 1
        this.repeat_number = 0
    }

    toJSON(){
        let date_due = this.date_due instanceof Date ? this.date_due.toISOString().substring(0,10) : this.date_due
        let o = {
            date_due: date_due,
            name: this.name,
            value: this.value,
            done: this.done,
            bank_account_id: this.bank_account_id,
            category_id: this.category_id,
        }
        
        if (this.repeat){
            o.repeat = this.repeat
            o.repeat_type = this.repeat_type
            o.repeat_number = this.repeat_number
        }

        return o
    }
}