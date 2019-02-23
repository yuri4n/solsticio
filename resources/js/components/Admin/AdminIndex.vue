<template>
    <div class="container my-5">
        <div v-if="$auth.isAuthenticated() && user.role == 'ADMIN'" class="card text-left">
            <div class="card-body">
                <h4 class="card-title">Bienvenida!</h4>
                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores repudiandae vitae deleniti labore? Cupiditate quia doloremque aspernatur dolore dolores quaerat in quidem reiciendis ipsam. Tempora, consequuntur voluptas. Aperiam, dicta atque.</p>
                <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima ad eligendi id sunt in expedita. Fugit accusamus ipsum delectus quo repellendus sit omnis ad, voluptate impedit quisquam adipisci repellat. Consequatur.</p>
            </div>
        </div>
        <div v-else class="card text-center">
            <div class="card-body">
                <h1 class="card-title display-1">Oops! Acceso Restringido!</h1>
                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores repudiandae vitae deleniti labore? Cupiditate quia doloremque aspernatur dolore dolores quaerat in quidem reiciendis ipsam. Tempora, consequuntur voluptas. Aperiam, dicta atque.</p>
                <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima ad eligendi id sunt in expedita. Fugit accusamus ipsum delectus quo repellendus sit omnis ad, voluptate impedit quisquam adipisci repellat. Consequatur.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  mounted() {
    if (this.$auth.isAuthenticated()) this.getUser();
  },
  data() {
    return {
      user: undefined
    };
  },
  methods: {
    getUser() {
      var url = "http://solsticio.local/api/auth/user";
      axios
        .get(url)
        .then(response => {
          this.user = response.data.data;
        })
        .catch();
    }
  }
};
</script>
