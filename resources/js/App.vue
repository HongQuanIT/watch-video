<template>
	<div class="app">
		<Layout>
			<router-view></router-view>
			<div>
				<div
					v-if="loading"
					class="text-center d-flex justify-content-between loading"
				>
					<b-spinner
						v-for="variant in variants"
						:variant="variant"
						:key="variant"
						type="grow"
					></b-spinner>
				</div>
			</div>
		</Layout>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
	data() {
		return {
			variants: ["success", "warning", "info"],
		};
	},
	methods: {},
	computed: {
		...mapGetters({
			loading: "common/loading",
		}),
	},
};
</script>
<style lang="scss" scoped>
.loading {
	width: 130px;
	position: fixed;
	top: 50%;
	left: 50%;
	margin-top: -1rem;
	margin-left: -4rem;
	z-index: 999;
}
</style>