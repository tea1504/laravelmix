const state = {
    user: {
        firstName: '',
        lastName: '',
        image: '',
        department_id: 0,
    },
    userInfo: {},
}

const getters = {
    getUser: state => {
        return state.user;
    },
    getUserInfo: state => {
        return state.userInfo;
    },
    isQuanLy: state => {
        return state.user.department_id == 1
    },
    isThuNgan: state => {
        return state.user.department_id == 2
    },
    isBep: state => {
        return state.user.department_id == 3
    },
    isPhucVu: state => {
        return state.user.department_id == 4
    },
}

const mutations = {
    setUser(state, user) {
        state.user = user;
    },
    setUserInfo(state, user) {
        state.userInfo = user;
    },
}

const actions = {
    setUser(context, user){
        context.commit('setUser', user);
    },
    setUserInfo(context, user){
        context.commit('setUserInfo', user);
    },
}

export default {
    state,
    getters,
    mutations,
    actions,
}
