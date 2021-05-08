<template>
  <div>
    <spinner v-if="!isLoaded" />
    <b-card
      header="Thêm mới món ăn"
      header-class="h1 font-weight-bold bg-gradient-teal"
    >
      <b-form-group
        label="Tên món ăn :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-input
          type="text"
          id="name"
          placeholder="Ví dụ: Canh chua cá lóc"
          v-model="dish.name"
          :state="errors.name | check"
          aria-describedby="name_err"
        ></b-form-input>
        <b-form-invalid-feedback id="name_err" v-if="errors.name">
          {{ errors.name[0] }}
        </b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="giá :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-input
          type="text"
          id="price"
          placeholder="Ví dụ: 50000"
          v-model="dish.price"
          :state="errors.price | check"
          aria-describedby="price_err"
        ></b-form-input>
        <b-form-invalid-feedback id="price_err" v-if="errors.price">
          {{ errors.price[0] }}
        </b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="Loại món ăn:"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-select
          id="type_id"
          v-model="dish.type_id"
          :state="errors.type_id | check"
          :options="type"
          aria-describedby="type_id_err"
        ></b-form-select>
        <b-form-invalid-feedback id="type_id_err" v-if="errors.type_id">{{
          errors.type_id[0]
        }}</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group
        label="Mô tả :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-textarea
          id="decription"
          v-model="dish.description"
          placeholder="Enter something..."
          rows="3"
          max-rows="6"
          :state="errors.description | check"
          aria-describedby="decription_err"
        ></b-form-textarea>
        <b-form-invalid-feedback id="decription_err" v-if="errors.description">
          {{ errors.description[0] }}
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
          v-model="dish.image"
          placeholder="Choose a file or drop it here..."
          drop-placeholder="Drop file here..."
          @change="change"
        ></b-form-file>
        <img
          id="output"
          src="http://demo.laravelmix.local:81/api/image/chung/default.png"
          class="mt-2"
          height="150px"
        />
      </b-form-group>
      <b-row
        ><b-col offset-sm="2" offset-md="1">
          <b-button @click="submit" class="bg-teal border-0">Lưu</b-button>
          <b-button :to="{ name: 'DishIndex' }">Trở về</b-button>
        </b-col></b-row
      >
    </b-card>
  </div>
</template>

<script>
import Dish from "../../apis/Dish";
import Type from "../../apis/Type";
import Spinner from "../../views/Spinner.vue";
import { mapActions } from "vuex";
export default {
  components: { Spinner },
  data() {
    return {
      dish: {
        type_id: "",
        name: "",
        price: "",
        image: "",
        description: "",
      },
      type: [],
      isLoaded: true,
      errors: [],
    };
  },
  methods: {
    ...mapActions(["setDish"]),
    change(e) {
      this.dish.image = e.target.files[0];
      this.loadFile(e);
    },
    loadFile(e) {
      var output = document.getElementById("output");
      output.src = URL.createObjectURL(e.target.files[0]);
    },
    default() {
      return {
        type_id: "",
        name: "",
        price: "",
        image: "",
        description: "",
      };
    },
    getType() {
      this.isLoaded = false;
      Type.index()
        .then((res) => {
          Array.from(res.data).forEach((arr) => {
            var temp = { text: null, value: null };
            temp.value = arr.id;
            temp.text = arr.name;
            this.type.push(temp);
          });
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
    dishIndex() {
      this.isLoaded = false;
      Dish.index()
        .then((res) => {
          this.setDish(res.data);
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
      formData.append("type_id", this.dish.type_id);
      formData.append("name", this.dish.name);
      formData.append("price", this.dish.price);
      formData.append("description", this.dish.description);
      formData.append("image", this.dish.image);
      Dish.create(formData)
        .then((res) => {
          this.dishIndex();
          this.$swal({
            icon: "success",
            title: "Lưu thành công",
          }).then(() => {
            this.type = this.default();
            this.$router.push({ name: "DishIndex" });
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
  filters: {
    check: function (value) {
      return value == null ? null : false;
    },
  },
  mounted() {
    this.getType();
  },
};
</script>

<style>
</style>