<template>
  <div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Users <Button @click="AddUsers"><Icon type="md-add" />Add User</Button></h3>

                        <div class="card-tools">
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <input
                              type="text"
                              name="table_search"
                              class="form-control float-right"
                              placeholder="Search"
                            />
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>User Name</th>
                              <th>User Type</th>
                              <th>Email</th>
                              <th>Created at</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="user in users" :key="user.id">
                              <td>{{ user.id }}</td>
                              <td>{{ user.fullName }}</td>
                              <td>{{ user.user_type }}</td>
                              <td>{{ user.email }}</td>
                              <td>{{ user.created_at }}</td>
                              <td>
                                <Button type="warning" size="small" @click="edit(user)"><i class="fa fa-pencil-alt text-white mr-1"></i>Edit</Button>
                                <Button type="error" size="small" @click="deleteUser(user)"><i class="fa fa-trash-alt text-white mr-1"></i>Delete</Button>
                                <!-- <a class="btn btn-danger btn-sm"><i class="fa fa-trash-alt text-white mr-1"></i>Delete</a>
                                <a class="btn btn-info btn-sm"><i class="fa fa-pencil-alt text-white mr-1"></i>Edit</a> -->
                              </td>
                            </tr>
                           
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Add Tag With modal -->
                    <template>
                      <Modal
                          v-model="modalAddTag"
                          :title="title"
                          :closable="true"
                          >
                          <div class="space">
                            <Input v-model="data.fullName" placeholder="Enter FullName..." style="width: 300px" />
                            <small class="alert alert-danger" v-if="errors && errors.fullName">{{ errors.fullName[0] }}</small>
                          </div>
                          <div class="space">
                            <Input v-model="data.email" placeholder="Enter Email..." style="width: 300px" />
                            <small class="alert alert-danger" v-if="errors && errors.email">{{ errors.email[0] }}</small>
                          </div>
                          <div class="space">
                            <Input v-model="data.password" placeholder="Enter Password..." style="width: 300px" />
                            <small class="alert alert-danger" v-if="errors && errors.password">{{ errors.password[0] }}</small>
                          </div>

                          <div class="space">
                            <Select v-model="data.user_type" style="width:200px" placeholder="Select Admin Type">
                              <Option value="admin">Admin</Option>
                              <Option value="editor">Editor</Option>
                          </Select>
                          </div>
                           
                          <div slot="footer">
                            <Button type="default" @click="modalAddTag=false">Close</Button>
                            <Button type="primary" v-show="!editMode" @click="addUser">Add User</Button>
                            <Button type="warning" v-show="editMode" @click="updateUser">Update User</Button>
                          </div>
                      </Modal>
                  </template>

                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>
<script>
export default {
  data(){
    return{
      data:{
        id: '',
        fullName: '',
        email: '',
        password: '',
        user_type: 'admin',
      },
      modalAddTag: false,
      errors: {},
      users:[],
      title: '',
      editMode: false
    }
  },
  methods:{
    AddUsers(){
      this.modalAddTag = true;
      this.title = "Add User";
      this.editMode = false;
      this.data = {};
    },
    async addUser(){
      
       const res = await this.callApi('post' , '/addUser' , this.data);
       console.log(res);
     if(res.status == 201)
      {
        this.success('Success' , 'User Added SuccessFully!!');
        this.modalAddTag = false;
        this.users.unshift(res.data);
        this.data.fullName = '';
        this.data.email = '';
        this.data.password = '';
        this.data.user_type = '';
      }else{
        this.errors = res.data.errors;
        console.log(res.data.errors);
      }
    },
    async getAllUsers(){
      const res = await this.callApi('get' , '/getAllUsers');
      this.users = res.data;
      //console.log(res);
    },
    edit(user){
      let obj = {
        id : user.id,
        fullName: user.fullName,
        email: user.email,
        password: user.password,
        user_type: user.user_type
      }
      this.modalAddTag = true;
      this.title = "Edit User";
      this.editMode = true;
      this.data = obj;
      console.log(obj);
    },
    async updateUser(){
      const res = await this.callApi('post' , `/updateUser` , this.data);
      console.log(res);
      if(res.status == 200)
      {
        this.success('Success' , 'User Updated SuccessFully!!');
        this.modalAddTag = false;
         this.getAllUsers();
       // this.tags.unshift(res.data);
      }else{
        this.errors = res.data.errors;
        console.log(res.data.errors);
        if(res.data.errors.name[0])
        {
          this.sth('error' , res.data.errors.name[0]);
        } 
      }
    },
    async deleteUser(user){
      if(!confirm('Are you sure to delete?'))return;
        const res = await this.callApi('delete' , `/deleteUser/${user.id}`);
        if(res.status == 200)
        {
          this.success('Success' , 'User Deleted SuccessFully!!');
          this.getAllUsers();
          
          //this.tags.unshift(res.data);
        }
      }
  },
  created(){
      this.getAllUsers();
  }
  
}
</script>