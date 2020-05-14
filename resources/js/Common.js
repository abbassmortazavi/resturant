import Axios from "axios"

export default{
    data() {
        return {
            
        }
    },
    methods: {
        async callApi(method , url , data){
            try{
               return await Axios({
                    method: method,
                    url: url,
                    data: data
                });
            }catch(e){
                return e.response;
            }
        },
        info (title , des) {
            this.$Notice.info({
                title: title,
                desc: des
            });
        },
        success (title , des) {
            this.$Notice.success({
                title: title,
                desc: des
            });
        },
        warning (title , des) {
            this.$Notice.warning({
                title: title,
                desc: des
            });
        },
        error (title , des) {
            this.$Notice.error({
                title: title,
                desc: des
            });
        },
        sth (title="wrong" , des="somthing wrong...!") {
            this.$Notice.error({
                title: title,
                desc: des
            });
        },
    }
}