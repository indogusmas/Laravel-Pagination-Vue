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
              <th>Person</th>
              <th width="200" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(person, index) in persons.data" :key="person.id">
              <td width="50" class="text-center">{{ index + 1 }}</td>
              <td>{{ person.first_name }}</td>
              <td width="200" class="text-center">
                <div class="btn-group">
                  <button class="btn btn-danger">Delete</button>
                </div>
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
  },
};
</script>