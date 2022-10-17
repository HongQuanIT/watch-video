<template>
	<div>
		<div v-if="user">Hi, {{ user.email }}</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	computed: {
		...mapGetters({
			user: "auth/user",
		}),
	},
	async created() {
		if (!this.user) {
			await this.$store.dispatch("auth/fetchUser");
		}
	},
};
</script>

<style lang="scss" scoped>
@import "assets/scss/_header.scss";
</style>
