import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import "u-reset.css";
import ElementUi from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import Vant from "vant";
import 'vant/lib/index.css';
import { Swipe, SwipeItem } from 'vant';
//下拉刷新
import { PullRefresh } from 'vant';
//上拉加载
import { List } from 'vant';
//图片懒加载
import { Lazyload } from 'vant';
//loading加载
import { Loading } from 'vant';
//粘性布局
import { Sticky } from 'vant';
//数字键盘
import { NumberKeyboard } from 'vant';
//单选框
import { RadioGroup, Radio } from 'vant';
import Toast from "vant";


Vue.config.productionTip = false;
Vue.use(ElementUi);
Vue.use(Vant);
Vue.use(Swipe).use(SwipeItem);
Vue.use(PullRefresh);
Vue.use(List);
// options 为可选参数，无则不传
Vue.use( Lazyload );
Vue.use(Loading);
Vue.use(Sticky);
Vue.use(NumberKeyboard);
Vue.use(RadioGroup).use(Radio);
Vue.use(Toast);


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
