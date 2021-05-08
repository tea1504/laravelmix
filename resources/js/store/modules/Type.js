const state = {
  type: [],
  fieldsType: [
    {
      key: 'id',
      label: 'ID',
      sortable: true,
    },
    {
      key: 'name',
      label: 'Tên loại món ăn',
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
  getType: state => {
    return state.type;
  },
  getFieldsType: state => {
    return state.fieldsType;
  }
}

const mutations = {
  setType(state, type) {
    state.type = type;
  }
}

const actions = {
  setType(context, type) {
    context.commit("setType", type);
  }
}

export default {
  state,
  getters,
  mutations,
  actions,
}