const state = {
  table: [],
  fieldsTable: [],
}

const getters = {
  getTable: state => {
    return state.table;
  },
  getFieldsTable: state => {
    return state.fieldsTable;
  }
}

const mutations = {
  setTable(state, table) {
    state.table = table;
  }
}

const actions = {
  setTable(context, table) {
    context.commit("setTable", table);
  }
}

export default {
  state,
  getters,
  mutations,
  actions
};