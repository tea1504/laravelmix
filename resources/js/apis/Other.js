import Api from './Api'

export default {
  getMonCho() {
    return Api().get('/moncho');
  },
  daCheBien(id) {
    return Api().post('/dachebien/' + id);
  },
  lenMon() {
    return Api().get('/lenmon');
  },
  daLen(id) {
    return Api().post('/dalen/' + id);
  },
  demMonCho() {
    return Api().get('/demmoncho');
  },
}