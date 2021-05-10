<template>
  <div>
    <div class="accordion" role="tablist">
      <b-card no-body class="mb-1" v-for="type in listDish" :key="type.id">
        <b-card-header header-tag="header" class="p-1" role="tab">
          <b-button
            block
            @click="$root.$emit('bv::toggle::collapse', 'type' + type.id)"
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
            <b-row cols="3" cols-md="4" cols-lg="6" cols-xl="8">
              <b-col
                v-for="dish in type.dishes"
                :key="dish.id"
                class="mt-2"
                style="cursor: pointer"
                @click="dishSelected = dish"
                v-b-modal.modal-multi-3
              >
                <b-img
                  thumbnail
                  fluid
                  :src="dish.image"
                  :alt="dish.name"
                ></b-img>
                {{ dish.name }}
              </b-col>
            </b-row>
          </b-card-body>
        </b-collapse>
      </b-card>
    </div>
    <b-modal
      id="modal-multi-3"
      size="md"
      title="Chọn số lượng"
      @ok="
        add(dishSelected, amount);
        amount = 1;
      "
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
        <b-col
          md="2"
          class="text-md-right"
          style="cursor: pointer"
          @click="minus"
        >
          <i class="fas fa-minus-square fa-2x"></i>
        </b-col>
        <b-col md="8">
          <b-form-input type="number" v-model="amount"> </b-form-input>
        </b-col>
        <b-col
          md="2"
          class="text-md-left"
          style="cursor: pointer"
          @click="plus"
        >
          <i class="fas fa-plus-square fa-2x"></i>
        </b-col>
      </b-row>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: {
    listDish: Array,
    add: Function,
  },
  data() {
    return {
      types: [],
      dishSelected: {},
      amount: 1,
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
  mounted() {},
};
</script>

<style>
</style>