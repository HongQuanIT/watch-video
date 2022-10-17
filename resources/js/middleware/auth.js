import Cookie from "js-cookie";

export default (to, from, next) => {

  if (to.meta.notAuthenticated) {
    return next();
  }

  if (Cookie.get('token')) {
    return next();
  }

  next('/login');
};