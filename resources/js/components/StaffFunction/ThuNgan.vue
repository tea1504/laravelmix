<template>
  <div style="height: 85vh">
    <b-container fluid class="h-100">
      <b-row class="h-100">
        <b-col md="4" class="h-100">
          <b-card class="h-100 m-0 overflow-auto">
            <div>
              <h3>Hóa đơn</h3>
              <table width="100%">
                <tr>
                  <th width="20%">
                    <h5>Bàn:</h5>
                  </th>
                  <td>
                    <h5>
                      {{
                        getBanTheoID(table_id) == null
                          ? "Chưa chọn bàn"
                          : getBanTheoID(table_id).table.name
                      }}
                    </h5>
                  </td>
                </tr>
                <tr>
                  <th width="20%">
                    <h5>Giờ vào:</h5>
                  </th>
                  <td>
                    <h5>
                      {{
                        getBanTheoID(table_id) == null
                          ? "Chưa chọn bàn"
                          : getBanTheoID(table_id).table.check_in
                      }}
                    </h5>
                  </td>
                </tr>
              </table>
              <b-table
                striped
                hover
                outlined
                responsive=""
                :items="listOrder"
                :fields="fields"
              >
                <template #cell(name)="row">
                  {{ row.item.dish.name }}
                </template>
                <template #cell(price)="row">
                  {{ row.item.dish.price | money }}
                </template>
                <template #cell(actions)="row">
                  <b-button
                    size="sm"
                    pill
                    style="border: none"
                    @click="minus(row.item.dish)"
                    ><i class="fas fa-minus"></i
                  ></b-button>
                  <b-button
                    size="sm"
                    pill
                    class="bg-teal"
                    style="border: none"
                    @click="plus(row.item.dish)"
                    ><i class="fas fa-plus"></i
                  ></b-button>
                  <b-button
                    size="sm"
                    pill
                    variant="danger"
                    style="border: none"
                    @click="xoa(row.item.dish)"
                    ><i class="fas fa-trash"></i
                  ></b-button>
                </template>
              </b-table>
              <b-button block @click="save()">Lưu</b-button>
              <b-button
                block
                @click="thanhtoan(getBanTheoID(table_id).table.invoice_id)"
                class="bg-teal border-0"
                :disabled="
                  table_id == 0 ? true : getBanTheoID(table_id).checked == 0
                "
                >Thanh toán</b-button
              >
            </div>
          </b-card>
        </b-col>
        <b-col md="5" class="h-100 border p-0">
          <b-card class="h-100 m-0 overflow-auto">
            <div>
              <h3>Bàn</h3>
              <b-container fluid class="h-100">
                <b-row cols="4">
                  <b-col
                    v-for="table in listTable"
                    @click="
                      showListOder(table.table.invoice_id);
                      table_id = table.table.id;
                    "
                    :key="table.table.id"
                  >
                    <div
                      class="text-center myicon"
                      :class="{ selected: table.checked }"
                    >
                      <span>{{ table.table.name }}</span>
                    </div>
                  </b-col>
                </b-row>
              </b-container>
            </div>
          </b-card>
        </b-col>
        <b-col md="3" class="h-100">
          <b-card class="h-100 overflow-auto">
            <div>
              <h3>Món ăn</h3>
              <div class="accordion" role="tablist">
                <b-card
                  no-body
                  class="mb-1"
                  v-for="type in listDish"
                  :key="type.id"
                >
                  <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-button
                      block
                      @click="
                        $root.$emit('bv::toggle::collapse', 'type' + type.id)
                      "
                      variant="info"
                      >{{ type.name }}</b-button
                    >
                  </b-card-header>
                  <b-collapse
                    :id="'type' + type.id"
                    accordion="my-accordion"
                    role="tabpanel"
                  >
                    <b-card-body>
                      <b-row cols="2">
                        <b-col
                          v-for="dish in type.dishes"
                          :key="dish.id"
                          class="mt-2"
                          style="cursor: pointer"
                          @click="add(dish, 1)"
                          v-b-modal.modal-multi-3
                        >
                          <div style="position: relative; height: 150px">
                            <b-img
                              thumbnail
                              fluid
                              :src="dish.image"
                              :alt="dish.name"
                              style="position: absolute; top: 0; right: 0"
                            ></b-img>
                            <span
                              style="position: absolute; bottom: 0"
                              class="text-center bg-dark text-white w-100"
                            >
                              {{ dish.name }}
                            </span>
                            <span
                              style="position: absolute; top: 0; right: 0"
                              class="text-center bg-dark text-white"
                            >
                              {{ dish.price | money }}
                            </span>
                          </div>
                        </b-col>
                      </b-row>
                    </b-card-body>
                  </b-collapse>
                </b-card>
              </div>
            </div>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import Table from "../../apis/Table";
import Invoice from "../../apis/Invoice";
import Type from "../../apis/Type";
export default {
  data() {
    return {
      isLoaded: true,
      listTable: [],
      listTableChecked: [],
      listOrder: [],
      table_id: 0,
      listDish: [],
      fields: [
        {
          key: "name",
          label: "Món ăn",
        },
        {
          key: "price",
          label: "Giá",
          tdClass: "text-right",
          thClass: "text-right",
        },
        {
          key: "amount",
          label: "Số lượng",
          tdClass: "text-right",
          thClass: "text-right",
        },
        {
          key: "actions",
          label: "Actions",
          tdClass: "text-center",
          thClass: "text-center",
        },
      ],
      total: 0,
      invoice: {
        id: 0,
        check_in: null,
        check_out: null,
        date: null,
        staff: null,
        table: null,
      },
    };
  },
  methods: {
    getBan() {
      this.isLoaded = false;
      Table.getBan()
        .then((res) => {
          Array.from(res.data).forEach((e) => {
            this.listTable.push({ table: e, checked: 0 });
          });
          this.getBanPhucVu();
          this.isLoaded = true;
        })
        .catch((err) => {
          this.isLoaded = true;
        });
    },
    getBanPhucVu() {
      this.isLoaded = false;
      Table.getBanPhucVu()
        .then((res) => {
          Array.from(res.data).forEach((e) => {
            var a = this.listTable.findIndex((b) => b.table.id == e.id);
            this.listTable[a].checked = 1;
          });
          this.isLoaded = true;
        })
        .catch((err) => {
          this.isLoaded = true;
        });
    },
    showListOder(id) {
      this.listOrder = [];
      this.total = 0;
      Invoice.show(id)
        .then((res) => {
          Array.from(res.data.dishes).forEach((arr) => {
            var temp = { dish: {}, amount: 0 };
            temp.dish = arr;
            temp.amount = arr.pivot.amount;
            this.total += temp.dish.price * temp.amount;
            this.listOrder.push(temp);
          });
        })
        .catch((err) => {});
    },
    add(dish, amount) {
      if (this.table_id != 0) {
        var index = this.listOrder.findIndex(
          (element) => element.dish.id == dish.id
        );
        if (index == -1) this.listOrder.push({ dish: dish, amount: amount });
        else {
          this.listOrder[index].amount =
            eval(this.listOrder[index].amount) + eval(amount);
        }
      } else {
        this.$swal("Bạn phải chọn bàn trước");
      }
    },
    plus(dish) {
      var index = this.listOrder.findIndex(
        (element) => element.dish.id == dish.id
      );
      this.listOrder[index].amount++;
    },
    minus(dish) {
      var index = this.listOrder.findIndex(
        (element) => element.dish.id == dish.id
      );
      if (this.listOrder[index].amount > 1) this.listOrder[index].amount--;
    },
    xoa(dish) {
      var index = this.listOrder.findIndex(
        (element) => element.dish.id == dish.id
      );
      this.listOrder.splice(index, 1);
    },
    getMonAn() {
      Type.getDetail()
        .then((res) => {
          var temp = [];
          var temp2 = [];
          temp = res.data;
          temp.forEach((arr) => {
            temp2 = arr;
            var temp3 = temp2.dishes.filter((res) => res.is_serving != 0);
            temp2.dishes = temp3;
            this.listDish.push(temp2);
          });
        })
        .catch((err) => {});
    },
    getBanTheoID(id) {
      if (id == 0) return null;
      var ban = Array.from(this.listTable).filter((e) => e.table.id == id);
      return ban[0];
    },
    save() {
      if (this.listOrder.length == 0) {
        this.$swal("Danh sách món ăn rỗng");
      } else {
        if (this.getBanTheoID(this.table_id).checked == 1) {
          this.update();
        } else {
          this.create();
        }
      }
    },
    create() {
      Invoice.create({
        table_id: this.table_id,
        listOrder: this.listOrder,
      })
        .then((res) => {
          var index = this.listTable.findIndex(
            (e) => e.table.id == this.table_id
          );
          this.listTable[index].checked = 1;
          var now = new Date();
          this.listTable[index].table.check_in =
            now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
          this.$swal({
            icon: "success",
            title: "Thêm mới thành công",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });
        })
        .catch((err) => {
          if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({
              name: "Login",
              query: { redirect: to.fullPath },
            });
          } else if (err.response.status == 422) {
            this.errors = err.response.data.errors;
          } else {
            this.$swal({
              icon: "error",
              title: "Lỗi",
              text: "Không thể lấy dữ liệu. Hãy thử lại sau.",
            });
          }
        });
    },
    update() {
      Invoice.update(
        {
          table_id: this.table_id,
          listOrder: this.listOrder,
        },
        this.getBanTheoID(this.table_id).table.invoice_id
      )
        .then((res) => {
          this.$swal({
            icon: "success",
            title: "Cập nhật thành công",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });
        })
        .catch((err) => {
          if (err.response.status == 422) {
            this.errors = err.response.data.errors;
          }
        });
    },
    thanhtoan(id) {
      this.$swal({
        title:
          "Thanh toán hóa đơn " +
          this.getBanTheoID(this.table_id).table.name +
          " ?",
        text: "Tổng tiền: " + this.total.toLocaleString("vi-VN") + " VNĐ",
        showCancelButton: true,
        confirmButtonText: `Thanh toán`,
      }).then((result) => {
        if (result.isConfirmed) {
          Invoice.thanhToan(id)
            .then((res) => {
              var index = this.listTable.findIndex(
                (e) => e.table.id == this.table_id
              );
              this.listTable[index].checked = 0;
              this.listTable[index].table.check_in = null;
              this.listOrder = [];
              this.$swal({
                icon: "success",
                title: "Thanh toán thành công",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
              });
            })
            .catch((err) => {
              if (err.response.status == 401) {
                localStorage.removeItem("token");
                this.$router.push({ name: "Login" });
              }
            });
        }
      });
    },
  },
  mounted() {
    this.getBan();
    this.getMonAn();
  },
  filters: {
    money: function (value) {
      return new Intl.NumberFormat("de-DE").format(value);
    },
  },
};
</script>

<style scope>
.myicon {
  background: url("http://demo.laravelmix.local:81/api/image/chung/table.png");
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
  height: 100px;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
}
.myicon span {
  font-size: 20px;
  font-weight: bold;
  color: black;
  background-color: #a8f0d0e8;
  padding: 20px;
  border-radius: 50%;
}
.selected span {
  background-color: #ffc5c5d1 !important;
}
</style>