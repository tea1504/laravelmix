<template>
  <div>
    <spinner v-if="!isLoaded" />
    <b-card
      header="Chỉnh sửa thông tin nhân viên"
      header-class="h1 font-weight-bold bg-gradient-teal"
    >
      <b-form-group
        label="Họ lót :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-input
          type="text"
          id="last_name"
          placeholder="Ví dụ: Trần Văn"
          v-model="staff.last_name"
          :state="errors.last_name | check"
          aria-describedby="last_name_err"
        ></b-form-input>
        <b-form-invalid-feedback id="last_name_err" v-if="errors.last_name">
          {{ errors.last_name[0] }}
        </b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="Tên :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-input
          type="text"
          id="first_name"
          placeholder="Ví dụ: Hòa"
          v-model="staff.first_name"
          :state="errors.first_name | check"
          aria-describedby="first_name_err"
        ></b-form-input>
        <b-form-invalid-feedback id="first_name_err" v-if="errors.first_name">
          {{ errors.first_name[0] }}
        </b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="Bộ phận:"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-select
          id="department_id"
          v-model="staff.department_id"
          :state="errors.department_id | check"
          :options="department"
          aria-describedby="department_id_err"
        ></b-form-select>
        <b-form-invalid-feedback
          id="department_id_err"
          v-if="errors.department_id"
          >{{ errors.department_id[0] }}</b-form-invalid-feedback
        >
      </b-form-group>
      <b-form-group
        label="Ngày sinh :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-datepicker
          :date-format-options="{
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
          }"
          id="date_of_birth"
          v-model="staff.date_of_birth"
          menu-class="w-100"
          calendar-width="100%"
          v-bind="label"
          :state="errors.date_of_birth | check"
          aria-describedby="date_of_birth_err"
        ></b-form-datepicker>
        <b-form-invalid-feedback
          id="date_of_birth_err"
          v-if="errors.date_of_birth"
        >
          {{ errors.date_of_birth[0] }}
        </b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="Số CCCD :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-input
          type="text"
          id="identity_card_number"
          placeholder="Nhập dãy 12 chữ số"
          v-model="staff.identity_card_number"
          :state="errors.identity_card_number | check"
          aria-describedby="identity_card_number_err"
        ></b-form-input>
        <b-form-invalid-feedback
          id="identity_card_number_err"
          v-if="errors.identity_card_number"
        >
          {{ errors.identity_card_number[0] }}
        </b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="Số điện thoại :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-input
          type="text"
          id="phone_number"
          placeholder="Nhập dãy 10 chữ số"
          v-model="staff.phone_number"
          :state="errors.phone_number | check"
          aria-describedby="phone_number_err"
        ></b-form-input>
        <b-form-invalid-feedback
          id="phone_number_err"
          v-if="errors.phone_number"
        >
          {{ errors.phone_number[0] }}
        </b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="Địa chỉ :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-input
          type="text"
          id="address"
          placeholder="Ví dụ: Số nhà 89, phố Tô Vĩnh Diễn, phường Khương Trung, quận Thanh Xuân, thành phố Hà Nội."
          v-model="staff.address"
          :state="errors.address | check"
          aria-describedby="address_err"
        ></b-form-input>
        <b-form-invalid-feedback id="address_err" v-if="errors.address">
          {{ errors.address[0] }}
        </b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="Hình ảnh :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-file
          v-model="staff.image"
          placeholder="Choose a file or drop it here..."
          drop-placeholder="Drop file here..."
          @change="change"
        ></b-form-file>
        <img id="output" :src="image" class="mt-2" height="150px" />
      </b-form-group>
      <b-row
        ><b-col offset-sm="2" offset-md="1">
          <b-button @click="submit" class="bg-teal border-0">Lưu</b-button>
          <b-button :to="{ name: 'StaffIndex' }">Trở về</b-button>
        </b-col></b-row
      >
    </b-card>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Department from "../../apis/Department";
import Staff from "../../apis/Staff";
import Spinner from "../../views/Spinner.vue";
export default {
  components: { Spinner },
  data() {
    return {
      staff: {
        department_id: "",
        first_name: "",
        last_name: "",
        date_of_birth: "",
        identity_card_number: "",
        phone_number: "",
        address: "",
        username: "",
        password: "",
        image: "",
      },
      label: {
        weekdayHeaderFormat: "narrow",
        labelPrevDecade: "Mười năm trước",
        labelPrevYear: "Năm trước",
        labelPrevMonth: "Tháng trước",
        labelCurrentMonth: "Tháng hiện tại",
        labelNextMonth: "Tháng sau",
        labelNextYear: "Năm sau",
        labelNextDecade: "Mười năm sau",
        labelToday: "Hôm nay",
        labelSelected: "Ngày đã chọn",
        labelNoDateSelected: "Không có ngày nào được chọn",
        labelCalendar: "Lịch",
        labelNav: "Điều hướng lịch",
        labelHelp: "Sử dụng các phím con trỏ để duyệt ngày tháng",
      },
      department: [],
      isLoaded: true,
      image: "",
      errors: [],
    };
  },
  methods: {
    ...mapActions(["setStaff"]),
    change(e) {
      this.staff.image = e.target.files[0];
      this.loadFile(e);
    },
    loadFile(e) {
      var output = document.getElementById("output");
      output.src = URL.createObjectURL(e.target.files[0]);
    },
    getDepartment() {
      this.isLoaded = false;
      Department.get()
        .then((res) => {
          Array.from(res.data).forEach((arr) => {
            var temp = { name: null, text: null };
            temp.value = arr.id;
            temp.text = arr.name;
            this.department.push(temp);
          });
          this.show();
          this.isLoaded = true;
        })
        .catch((err) => {
          if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({ name: "Login" });
          }
          this.isLoaded = true;
        });
    },
    show() {
      this.isLoaded = false;
      Staff.show(this.$route.params.id)
        .then((res) => {
          this.staff = res.data;
          this.image = this.staff.image;
          this.staff.image = null;
          this.isLoaded = true;
        })
        .catch((err) => {
          if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({ name: "Login" });
          }
          this.isLoaded = true;
        });
    },
    staffIndex() {
      this.isLoaded = false;
      Staff.index()
        .then((res) => {
          this.setStaff(res.data);
          this.isLoaded = true;
        })
        .catch((err) => {
          if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({ name: "Login" });
          }
          this.isLoaded = true;
        });
    },
    submit() {
      this.isLoaded = false;
      var formData = new FormData();
      formData.append("department_id", this.staff.department_id);
      formData.append("first_name", this.staff.first_name);
      formData.append("last_name", this.staff.last_name);
      formData.append("date_of_birth", this.staff.date_of_birth);
      formData.append("identity_card_number", this.staff.identity_card_number);
      formData.append("phone_number", this.staff.phone_number);
      formData.append("address", this.staff.address);
      formData.append("image", this.staff.image);
      Staff.update(formData, this.$route.params.id)
        .then((res) => {
          this.staffIndex();
          this.$swal({
            icon: "success",
            title: "Lưu thành công",
            text: "",
          }).then(() => {
            this.show();
            this.errors = [];
          });
          this.isLoaded = true;
        })
        .catch((err) => {
          if ((err.response.status = 422))
            this.errors = err.response.data.errors;
          else if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({ name: "Login" });
          }
          this.isLoaded = true;
        });
    },
  },
  mounted() {
    this.getDepartment();
  },
  filters: {
    check: function (value) {
      return value == null ? null : false;
    },
  },
};
</script>

<style>
</style>