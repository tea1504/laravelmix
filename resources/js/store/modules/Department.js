const state = {
  department: [],
  fieldsDepartment: [
    {
      key: 'id',
      label: 'ID',
      sortable: true,
    },
    {
      key: 'name',
      label: 'Tên bộ phận',
      sortable: true,
    },
    {
      key: 'created_at',
      label: 'Ngày tạo',
      sortable: true,
    },
    {
      key: 'updated_at',
      label: 'ngày cập nhật',
      sortable: true,
    },
    {
      key: 'actions',
      label: 'Actions',
    },
  ]
}

const getters = {
  getDepartment: state => {
    return state.department;
  },
  getFieldsDepartment: state => {
    return state.fieldsDepartment;
  },
}

const mutations = {
  setDepartment(state, department) {
    state.department = department;
  },
}

const actions = {
  setDepartment(context, department) {
    context.commit("setDepartment", department);
  }
}

export default {
  state,
  getters,
  mutations,
  actions
}