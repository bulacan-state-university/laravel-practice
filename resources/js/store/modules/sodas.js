import api from '../../api/api'

const state = {
  sodas: [],
  dummy: 'test'
}

const getters = {
  LIST: state => state.sodas,
  TEST: state => state.dummy
}

const mutations = {
  SET_SODAS: (state, payload) => { state.sodas = payload }
}

const actions = {
  GET: async ({ commit }) => {
    return await api.get('/api/sodas')
      .then((response) => {
        commit('SET_SODAS', response?.data?.data)
      })
  },

  SAVE: async ({ commit }, data) => {
    return await new Promise((resolve, reject) => {
      return api.post('/api/sodas', data)
        .then((response) => {
          resolve(response?.data)
        })
        .catch((e) => {
          reject(e.response?.data)
        })
    })
  },

  UPDATE: async ({ commit }, payload) => {
    return await new Promise((resolve, reject) => {
      api.patch(`/api/sodas/${payload.id}`, payload.data)
        .then((response) => {
          resolve(response?.data)
        })
        .catch((e) => {
          reject(e.response?.data)
        })
    })
  },

  DELETE: async ({ commit }, payload) => {
    return await new Promise((resolve, reject) => {
      api.delete(`/api/sodas/${payload.id}`)
        .then((response) => {
          resolve(response?.data)
        })
        .catch((e) => {
          reject(e.response?.data)
        })
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
