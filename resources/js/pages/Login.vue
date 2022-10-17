<template>
	<div class="login text-center">
		<form class="form-signin" @submit.prevent="signIn">
			<img
				class="mb-4"
				src="https://pim.itsabeautifulway.xyz/images/logo.png"
				alt=""
			/>
			<label for="inputEmail" class="sr-only">{{ $t("auth.txt_email") }}</label>
			<input
				v-model="user.email"
				name="email"
				class="form-control"
				:placeholder="$t('auth.txt_email')"
				required
				autofocus
			/>
			<br />
			<label for="inputPassword" class="sr-only">{{
				$t("auth.txt_password")
			}}</label>
			<input
				v-model="user.password"
				name="password"
				type="password"
				class="form-control"
				:placeholder="$t('auth.txt_password')"
				required
			/>
			<div class="checkbox mb-3"></div>
			<button
				class="btn btn-lg btn-primary btn-block"
				:disabled="submitted"
				type="submit"
			>
				{{ $t("auth.txt_sign_in") }}
			</button>
		</form>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
	data() {
		return {
			user: {
				password: "pimmm2021",
				email: "admin@itsabeautifulway.xyz",
			},
			submitted: false,
		};
	},
	computed: {},
	mounted() {},
	methods: {
		async signIn(e) {
			this.submitted = true;
			this.$store.commit("common/setLoading", true);
			let response = await this.$store.dispatch("auth/signIn", {
				...this.user,
			});
			if(response?.status == "success") {
				this.$router.push({ name: "home" });
			}
			this.submitted = false;
			this.$store.commit("common/setLoading", false);
		},
	},
};
</script>
<style lang="scss" scoped>
@import "assets/scss/_login.scss";
</style>