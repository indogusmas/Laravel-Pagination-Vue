<template>
  <div class="container">
    <br />
    <br />
     <ol class="breadcrumb">
        <li><router-link :to="{ name: 'home' }"><i class="fa fa-dashboard"></i> Home</router-link>
        <li class="active">{{ $route.meta.title }}</li>
    </ol>
    <div class="card">
      <div class="card-header">Create Employee</div>
      <div class="card-body">
        <form @submit.prevent="add">
          <div class="form-group">
            <label for="inputname">First Name</label>
            <input type="text" class="form-control" v-model="form.first_name" />
          </div>
          <div class="form-group">
            <label for="inputname">Last Name</label>
            <input type="text" class="form-control" v-model="form.last_name" />
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    data(){
        return{
            form:{
                first_name:'',
                last_name:''
            }
        }
    },
    methods:{
        add(){
            let url = '/api/person';
            axios.post(url, this.form).then(res => {
                this.form = '';
                this.alert(res.data.message);
            })
            this.alert()
        },
         alert(pesan) {
          this.$swal({
            title: "Perhatian",
            text: pesan,
            icon: "success",
          });
        }
    }
}
</script>