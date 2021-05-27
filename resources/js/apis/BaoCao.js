import Api from './Api'

export default {
  layDoanhThuTheoNam(form){
    return Api().post('/baocao/doanhthutheonam', form);
  },
  layDoanhThuTheoThang(form){
    return Api().post('/baocao/doanhthutheothang', form);
  },
}