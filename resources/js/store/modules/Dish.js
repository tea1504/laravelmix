const state = {
  dish: [],
  fieldsDish: [
    {
      key: "id",
      label: "ID",
      sortable: true
    },
    {
      key: "type",
      label: "Loại món ăn",
      sortable: true
    },
    {
      key: "name",
      label: "Tên món ăn",
      sortable: true
    },
    {
      key: "price",
      label: "Giá",
      sortable: true,
    },
    {
      key: "image",
      label: "Hình ảnh",
      sortable: true,
    },
    {
      key: 'description',
      label: "Mô tả",
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
  ],
}

const getters = {
  getDish: state => {
    return state.dish;
  },
  getFieldsDish: state => {
    return state.fieldsDish;
  },
}

const mutations = {
  setDish(state, dish) {
    state.dish = dish;
  },
}

const actions = {
  setDish(context, dish) {
    context.cpmmit('setDish', dish);
  }
}

export default {
  state,
  getters,
  mutations,
  actions
};