const state = {
  invoice: [],
  fieldsInvoice: [],
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