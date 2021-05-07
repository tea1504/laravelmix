const state = {
  table: [],
  fieldsTable: [
    {
      key: 'id',
      label: 'ID',
      sortable: true,
    },
    {
      key: 'name',
      label: 'Bàn',
      sortable: true,
    },
    {
      key: 'created_at',
      label: 'Ngày tạo',
      sortable: true,
    },
    {
      key: 'updated_at',
      label: 'Ngày cập nhật',
      sortable: true,
    },
    {
      key: 'actions',
      label: 'Actions',
    },
  ],
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