import VueRouter from 'vue-router';
import routes from './routes';
import AuthenticationMiddleware from 'middleware/auth';

const router = new VueRouter({
  mode: 'history',
  routes
})

router.beforeEach(AuthenticationMiddleware);

export default router;