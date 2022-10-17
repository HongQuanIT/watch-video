<template>
	<div>
    <div class="bd-navbar text-right pr-3 pt-3">
		  <TheHeader />
    </div>
		<div class="container-fluid">
			<div class="row flex-xl-nowrape">
				<div class="bd-sidebar border-bottom-0 col-md-3 col-xl-2 col-12">
          <TheMenu />
        </div>
				<div class="bd-content col-md-9 col-xl-10 col-12 pb-md-3 pl-md-5">
					<slot />
				</div>
			</div>
			<TheFooter />
		</div>
	</div>
</template>


<script>
const TheHeader = () =>
	import(
		/*webpackChunkName: "TheHeader", webpackPrefetch: true*/ "components/partials/TheHeader"
	);
const TheFooter = () =>
	import(
		/*webpackChunkName: "TheFooter", webpackPrefetch: true*/ "components/partials/TheFooter"
	);

const TheMenu = () =>
	import(
		/*webpackChunkName: "TheMenu", webpackPrefetch: true*/ "components/partials/TheMenu"
	);

export default {
	components: {
		TheHeader,
		TheFooter,
    TheMenu,
	},
};
</script>
<style lang="scss">
@import "assets/scss/_layout.scss";
</style>