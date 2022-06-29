import api from '../../Api/api'

const state = {
sodas:[]
}

const getters = {
LIST:state => state.sodas
}

const mutations = {
SET_SODAS: (state, payload) => (state.sodas = payload)
}

const actions = {
 GET: async({ commit }) => {
    return await api.get('/api/sodas').then((response) => {
        console.log(response)
        commit('SET_SODAS', response?.data?.data)
    })
 }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
