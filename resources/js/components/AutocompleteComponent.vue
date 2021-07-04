<template>
    <div>
        <input type="text" v-model="keyword">
        <ul v-if="staffs.length > 0">
            <li v-for="staff in staffs" :key="staff.id" v-text="staff.name"></li>
        </ul>


        <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Gender</th>
                              <th scope="col">Jobtitle</th>
                              <th scope="col">Contact Number</th>
                              <th scope="col" class="pl-3">Edit</th>
                              <th scope="col">Delete</th>
                            </tr>
                          </thead>

                          <tbody id="tb">
                            <tr v-for="staff in staffs" :key="staff.id" >
                                    <td >{{ staff.id }}</td>
                                    <td >{{ staff.stfName }}</td>
                                    <td >{{ staff.email }}</td>
                                    <td >{{staff.jobtitles_id}}</td>
                                    <td>{{staff.stfConactNo}}</td>
                                     
                                
                            </tr>
                          </tbody>
                         
                    </table>
    </div>


    
</template>

<script>
export default {
    data() {
        return {
            keyword: null,
            staffs: []
        };
    },
    watch: {
        keyword(after, before) {
            this.getResults();
        }
    },
    methods: {
        getResults() {
            axios.get('staff/staffacct/search', { params: { keyword: this.keyword } })
                .then(res => this.staffs = res.data)
                .catch(error => {});
        }
    }
}
</script>