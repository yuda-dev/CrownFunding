export default {
    namespaced: true,
    state: {
        status: false,
        color: 'success',
        text: ''
    },

    mutations: {
        set: (state, payload) => {
            state.status = payload.status
            state.text = payload.text
            state.color = state.color
        }
    },

    actions: {
        set: ({
            commit
        }, paylaod) => {
            commit('set', paylaod)
        }
    },

    getters: {
        status: state => state.status,
        color: state => state.color,
        text: state => state.text
    }
}