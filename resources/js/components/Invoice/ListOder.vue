<template>
  <div class="mt-3">
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
          class="bg-teal"
          style="border: none"
          v-b-tooltip.hover
          title="Sửa"
          v-b-modal.modal-edit
          @click="
            dishSelected = row.item.dish;
            amount = row.item.amount;
          "
          ><i class="fas fa-pen"></i
        ></b-button>
        <b-button
          size="sm"
          pill
          variant="danger"
          style="border: none"
          v-b-tooltip.hover
          title="Xóa"
          @click="xoa(row.item.dish)"
          ><i class="fas fa-trash"></i
        ></b-button>
      </template>
    </b-table>
    <b-modal
      id="modal-edit"
      size="md"
      title="Chọn số lượng"
      @ok="edit(dishSelected, amount)"
      cancel-title="Hủy"
    >
      <b-row>
        <b-col md="12" class="text-center">
          <b-img
            thumbnail
            fluid
            :src="dishSelected.image"
            :alt="dishSelected.name"
          ></b-img>
        </b-col>
        <b-col md="12">
          <p class="text-center h1">{{ dishSelected.name }}</p>
        </b-col>
        <b-col md="2" class="text-md-right" style="cursor: pointer">
          <b-button @click="minus" variant="success">
            <i class="fas fa-minus-square fa-2x"></i>
          </b-button>
        </b-col>
        <b-col md="8">
          <b-form-input type="number" v-model="amount"> </b-form-input>
        </b-col>
        <b-col md="2" class="text-md-left" style="cursor: pointer">
          <b-button @click="plus" variant="success">
            <i class="fas fa-plus-square fa-2x"></i>
          </b-button>
        </b-col>
      </b-row>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: {
    listOrder: Array,
    edit: Function,
    xoa: Function,
  },
  data() {
    return {
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
      dishSelected: {},
      amount: 0,
    };
  },
  methods: {
    plus() {
      this.amount++;
    },
    minus() {
      this.amount--;
    },
  },
  filters: {
    money: function (value) {
      return new Intl.NumberFormat("de-DE").format(value) + " vnđ";
    },
  },
};
</script>

<style>
</style>