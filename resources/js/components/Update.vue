<template>
  <div class="container">
    <br />
    <br />
    <div class="col">
      <ol class="breadcrumb">
        <li>
          <router-link :to="{ name: 'home' }">
            <i class="fa fa-dashboard"></i> Home
          </router-link>
        </li>
        <li class="active">Edit Person</li>
      </ol>
      <div class="card">
        <div class="card-body">
          <div class="card-body">
            <form @submit.prevent="updatePerson">
              <div class="form-group">
                <label for="inputname">First Name</label>
                <input type="text" class="form-control" v-model="form.first_name" />
              </div>
              <div class="form-group">
                <label for="inputname">Last Name</label>
                <input type="text" class="form-control" v-model="form.last_name" />
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        id: "",
        first_name: "",
        last_name: "",
      },
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      let idPerson = this.$route.params.idPerson;
      let endPoint = "api/person/" + idPerson;
      axios.get(endPoint).then((response) => {
        this.form = response.data;
      });
    },
    updatePerson(){
        let endPointUpdate = "api/person/"+ this.form.id;
        axios.put(endPointUpdate,this.form)
        .then(response => {
          this.$swal({
            title: "Perhatian",
            text: response.data.message,
            icon: "success",
          })
          this.router.go(1)
        })

    }
  },
};
</script>