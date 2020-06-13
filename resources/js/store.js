export default{
    state:{
        isLoggedIn: false
    },
    getters:{

    },
    actions:{

    },
    mutations:{
        checkIsUserLoggedIn(state , data){
            state.isLoggedIn = data;
        }
    }
}
