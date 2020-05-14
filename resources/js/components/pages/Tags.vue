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
                <h3 class="card-title">Tags</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Tags <Button @click="modalAddTag = true"><Icon type="md-add" />Add Tag</Button></h3>

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
                              <th>Tag Name</th>
                              <th>Created at</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="tag in tags" :key="tag.id">
                              <td>{{ tag.id }}</td>
                              <td>{{ tag.name }}</td>
                              <td>{{ tag.created_at }}</td>
                              <td>
                                <Button type="warning" size="small"><i class="fa fa-pencil-alt text-white mr-1"></i>Edit</Button>
                                <Button type="error" size="small"><i class="fa fa-trash-alt text-white mr-1"></i>Delete</Button>
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
                          title="Common Modal dialog box title"
                          :closable="true"
                          >
                           <Input v-model="data.name" placeholder="Enter something..." style="width: 300px" />
                           <small class="alert alert-danger" v-show="modalAddTag" v-if="errorData">{{ errorData }}</small>
                          <div slot="footer">
                            <Button type="default" @click="modalAddTag=false">Close</Button>
                            <Button type="primary" @click="addTag">Add Tag</Button>
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
        name: '',
      },
      modalAddTag: false,
      errorData: false,
      tags:[]
    }
  },
  methods:{
    async addTag(){
      if(this.data.name.trim() == ''){
        let message = 'field is empty!!';
        this.modalAddTag = true;
        this.errorData = message;
        return this.error('error' , message);
      }
      
      const res = await this.callApi('post' , '/addTag' , this.data);
      if(res.status == 201)
      {
        this.success('Success' , 'Tag Added SuccessFully!!');
        this.modalAddTag = false;
        this.getAllTags();
      }else{
        this.sth('error' , 'Somthing Wrong!!');
      }
    },
    async getAllTags(){
      const res = await this.callApi('get' , '/getAllTags');
      this.tags = res.data;
      //console.log(res);
    }
  },
  created(){
      this.getAllTags();
      console.log(this.tags);
  }
  
}
</script>