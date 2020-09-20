<template>
  <div>
    <div class="container">
      <div class="col-md-12">
        <br />
        <br />
        <div class="row">
          <div class="col-md-10">
            <h4>Person</h4>
          </div>
          <div class="col-md-2">
            <router-link class="btn btn-primary w-100" to="/create">+ Tambah</router-link>
          </div>
        </div>
        <br />
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="50" class="text-center">No</th>
              <th>FirstName</th>
              <th>LastName</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(person, index) in persons.data" :key="person.id">
              <td width="50" class="text-center">{{ index + 1 }}</td>
              <td>{{ person.first_name }}</td>
              <td>{{ person.last_name }}</td>
              <td width="200" class="text-center">
                <router-link :to="{name: 'editPerson',params:{idPerson:person.id}}" class="btn btn-link">Edit</router-link>|
                <a
                  href="#"
                  class="btn btn-link"
                  v-on:click="deletePerson(person.id, index,person.first_name)"
                >Delete</a>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination :data="persons" @pagination-change-page="loadData"></pagination>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //variable  for response  from backend api
      persons: {},
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData(page) {
      //fetch data from api use axios
      let url = "api/person?page=" + page;
      axios
        .get(url)
        .then((response) => {
          return response.data;
        })
        .then((data) => {
          this.persons = data;
          console.log(this.persons.data);
        });
    },
    deletePerson(id, index, name) {
      this.$swal({
        title: "Yakin menghapus person " + name + "?",
        icon: "warning",
        button: true,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Yes!",
      }).then((result)=>{
        if(result.value){
          let endPoint = 'api/person/'+ id;
          axios.delete(endPoint)
          .then(response => {
            this.$swal(response.data.message);
            this.loadData();
          })
        }
      })
    },
  },
};
</script>