const state = {
  staff: [],
  fields: [
    {
      key: "id",
      label: "ID",
      sortable: true
    },
    {
      key: "department",
      label: "Bộ phận",
      sortable: true
    },
    {
      key: "last_name",
      label: "Họ",
      sortable: true
    },
    {
      key: "first_name",
      label: "Tên",
      sortable: true,
    },
    {
      key: "date_of_birth",
      label: "Ngày sinh",
      sortable: true,
    },
    {
      key: 'identity_card_number',
      label: "Số CCCD",
      sortable: true,
    },
    {
      key: 'phone_number',
      label: "Số điện thoại",
      sortable: true,
    },
    {
      key: 'address',
      label: "Địa chỉ",
      sortable: true,
    },
    {
      key: 'image',
      label: "Ảnh",
      sortable: true,
    },
    {
      key: 'created_at',
      label: "Ngày tạo",
      sortable: true,
    },
    {
      key: 'updated_at',
      label: "Ngày cập nhật",
      sortable: true,
    },
    {
      key: 'actions',
      label: 'Actions'
    }
  ]
};

const getters = {
  getStaff: state => {
    return state.staff;
  },
  getFields: state => {
    return state.fields;
  }
};

const mutations = {
  setStaff(state, staff) {
    state.staff = staff;
  },
  setStaffPagination(state, pagination) {
    state.staffPagination = pagination;
  },
};

const actions = {
  setStaff(context, staff) {
    context.commit("setStaff", staff);
  }
};

export default {
  state,
  getters,
  mutations,
  actions
};
