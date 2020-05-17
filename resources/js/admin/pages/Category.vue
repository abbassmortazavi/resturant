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
                <h3 class="card-title">Category</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Category <Button @click="AddCategory"><Icon type="md-add" />Add Category</Button></h3>

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
                              <th>Category Name</th>
                              <th>Image</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="category in categories" :key="category.id">
                              <td>{{ category.id }}</td>
                              <td>{{ category.name }}</td>
                              <td>
                                <img :src="`/uploads/${category.image}`" width="100" height="100"/>
                              </td>
                              <td>
                                <Button type="warning" size="small" @click="edit(category)"><i class="fa fa-pencil-alt text-white mr-1"></i>Edit</Button>
                                <Button type="error" size="small" @click="deletecategory(category)"><i class="fa fa-trash-alt text-white mr-1"></i>Delete</Button>
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
                          v-model="modalCategory"
                          :title="title"
                          :closable="true"
                          >
                          <Upload
                            multiple
                            type="drag"
                            :headers= "{'x-csrf-token' : token , 'X-Requested-With' : 'XMLHttpRequest'}"
                            :on-success="handleSuccess"
                            :on-error="handleOnerror"
                            :format="['jpg','jpeg','png']"
                            :max-size="2048"
                            :on-format-error="handleFormatError"
                            :on-exceeded-size="handleMaxSize"
                            action="/uploadImage">
                            <div style="padding: 20px 0">
                                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                <p>Click or drag files here to upload</p>
                            </div>
                        </Upload>
                        <small class="alert alert-danger" v-show="errors.image" v-if="errors && errors.image">{{ errors.image[0] }}</small>
                        <div class="image_thumb" v-if="data.image">
                          <div class="demo-upload-list-cover">
                              <Icon type="md-trash" @click="deleteImage" />
                              <img :src="`/uploads/${data.image}`"/>
                          </div>
                         
                        </div>
                        <div class="space"></div>
                           <Input v-model="data.name" placeholder="Enter something..." style="width: 300px" />
                           <small class="alert alert-danger" v-if="errors && errors.name">{{ errors.name[0] }}</small>
                          <div slot="footer">
                            <Button type="default" @click="modalCategory=false">Close</Button>
                            <Button type="primary" v-show="!editMode" @click="insertCategory">Add Category</Button>
                            <Button type="warning" v-show="editMode" @click="updateCategory">Update Category</Button>
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
        id:'',
        name: '',
        image: '',
      },
      modalCategory: false,
      errors: {},
      tags:[],
      categories:[],
      title: '',
      editMode: false,
      token: ''
    }
  },
  methods:{
    AddCategory(){
      this.modalCategory = true;
      this.title = "Add Category";
      this.editMode = false;
    },
    async insertCategory(){
      const res = await this.callApi('post' , '/insertCategory' , this.data);

      if(res.status == 201)
      {
        this.success('Success' , 'Tag Added SuccessFully!!');
        this.modalCategory = false;
        // this.getAllTags();
        this.categories.unshift(res.data);
        this.data.name = '';
        this.data.image = '';
      }else{
        this.errors = res.data.errors;
        console.log(res.data.errors);
        if(res.data.errors.name[0])
        {
          this.sth('error' , res.data.errors.name[0]);
        } 
      }
    },
    async getAllCategories(){
      const res = await this.callApi('get' , '/getAllCategories');
      this.categories = res.data;
      console.log(res);
    },
    edit(category){
      let obj = {
        id : category.id,
        name: category.name,
        image: category.image
      }
      this.modalCategory = true;
      this.title = "Edit Category";
      this.editMode = true;
      this.data = obj;
    },
    async updateCategory(){
      const res = await this.callApi('post' , `/updateCategory` , this.data);
      if(res.status == 200)
      {
        this.success('Success' , 'Category Updated SuccessFully!!');
        this.modalCategory = false;
         this.getAllCategories();
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
    async deletecategory(category){
      if(!confirm('Are you sure to delete?'))return;
        const res = await this.callApi('delete' , `/deleteCategory/${category.id}`);
        if(res.status == 200)
        {
          this.success('Success' , 'category Deleted SuccessFully!!');
          this.getAllCategories();
          
          //this.tags.unshift(res.data);
        }
      },
  
     handleSuccess (res, file) {
          this.data.image = res;
      },
      handleFormatError (file) {
          this.$Notice.warning({
              title: 'The file format is incorrect',
              desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
          });
      },
      handleOnerror(res, file){
        this.$Notice.warning({
              title: 'The file format is incorrect',
              desc: 'File format of ' + file.errors.file[0] + ' is incorrect, please select jpg or png.'
          });
        console.log('res' , res);
        console.log('file' , file);
      },
      handleMaxSize (file) {
          this.$Notice.warning({
              title: 'Exceeding file size limit',
              desc: 'File  ' + file.name + ' is too large, no more than 2M.'
          });
      },
      async deleteImage(){
        let image = this.data.image;
        this.data.image = '';
        const res = await this.callApi('post' , '/deleteImage' , {image:image});
        if(res.status !=200){
          this.data.image = image;
          this.sth();
        }
         this.success('Success' , 'Image Deleted SuccessFully!!');
      }
  },
  created(){
      this.getAllCategories();
      this.token = window.Laravel.csrfToken;
      
  }
  
}
</script>