import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import colors from 'vuetify/lib/util/colors';

Vue.use(Vuetify)

const opts = {
    theme: {
        dark: true,
        themes: {
            themes: {
                light: {
                    primary: colors.lightBlue,
                    secondary: colors.grey.darken1,
                    accent: colors.pink.darken1,
                    error: colors.red.accent3,
                    background: colors.indigo.lighten5,
                    info: colors.teal.darken1,
                },
                dark: {
                    primary: colors.blue.darken4,
                    background: '#303030',
                    info: colors.teal.lighten1,
                },
            },
        }
    }
}

export default new Vuetify(opts)