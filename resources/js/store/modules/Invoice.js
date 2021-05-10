const state = {
  invoice: [],
  fieldsInvoice: [
    {
      key: "id",
      label: "ID",
      sortable: true
    },
    {
      key: "date",
      label: "Ngày tạo",
      sortable: true
    },
    {
      key: "is_paid",
      label: "Trạng thái",
      sortable: true
    },
    {
      key: "table",
      label: "Bàn",
      sortable: true
    },
    {
      key: "staff",
      label: "Nhân viên",
      sortable: true
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
      label: 'Actions',
      tdClass: "text-center",
      thClass: "text-center",
    }
  ],
}

const getters = {
  getInvoice: state => {
    return state.invoice;
  },
  getFieldsInvoice: state => {
    return state.fieldsInvoice;
  },
}

const mutations = {
  setInvoice(state, invoice) {
    state.invoice = invoice;
  },
}

const actions = {
  setInvoice(context, invoice) {
    context.commit('setInvoice', invoice);
  },
}

export default {
  state,
  getters,
  mutations,
  actions,
};