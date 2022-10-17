<template>
	<nav class="menu-list">
		<b-list-group class="menu-group">
			<b-list-group-item class="menu-item">
				<router-link :to="{ name: 'home' }"><strong>Home</strong></router-link>
			</b-list-group-item>
		</b-list-group>
		<b-list-group class="menu-group">
			<b-list-group-item class="menu-item">
				<strong>Clients</strong>
			</b-list-group-item>
			<b-list-group-item class="menu-item menu-item-sub">
				<router-link :to="{ name: 'client-list'}">List</router-link>
			</b-list-group-item>
		</b-list-group>
		<b-list-group class="menu-group">
			<b-list-group-item class="menu-item">
				<strong>Projects</strong>
			</b-list-group-item>
			<b-list-group-item class="menu-item menu-item-sub">
				<router-link :to="{ name: 'project-list'}">List</router-link>
			</b-list-group-item>
			<!-- <b-list-group-item class="menu-item menu-item-sub">
				<router-link to="/">Create</router-link>
			</b-list-group-item> -->
		</b-list-group>
		<b-list-group class="menu-group">
			<b-list-group-item class="menu-item" @click="logout()">
				<a href="#">Logout</a>
			</b-list-group-item>
		</b-list-group>
	</nav>
</template>

<script>
</script>

<script>
import { mapGetters } from "vuex";

export default {
	methods: {
		async logout() {
			this.$store.commit("common/setLoading", true);
			await this.$store.dispatch("auth/logout");
			this.$store.commit("common/setLoading", false);
			this.$router.push({ name: "login" })
			
		},
	},
};
</script>

<style lang="scss" scoped>
@import "assets/scss/_header.scss";
</style>
