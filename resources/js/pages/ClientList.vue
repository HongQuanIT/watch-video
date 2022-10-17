<template>
  <div>
    <b-table striped hover :items="items" :fields="fields"></b-table>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        fields: ['first_name', 'last_name', 'age'],
        items: []
      }
    },
    async created(){
        this.$store.commit("common/setLoading", true);
        await this.$store.dispatch("auth/fetchUser");
        this.items = [
          { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
        ]
        this.$store.commit("common/setLoading", false);
    }
  }
</script>