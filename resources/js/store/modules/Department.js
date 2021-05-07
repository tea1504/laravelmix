const state = {
  department: []
}

const getters = {
  getDepartment: state => {
    return state.department;
  },
}

const mutations = {
  setDepartment(state, department){
    state.department = department;
  },
}

const actions = {
  setDepartment(context, department){
    context.commit("setDepartment", department);
  }
}

export default {
  state,
  getters,
  mutations,
  actions
}