import axios from 'axios'

export default function useAuthUser () {
  const login = async ({ email, password }) => {
    const data = { email, password }
    await axios.get('http://localhost:8080/sanctum/csrf-cookie').then(async () => {
      await axios.post('http://localhost:8080/api/login', data).then(response => {
        localStorage.setItem('token', response.data.token)
      }).catch((error) => {
        throw new Error(error.response.data.reason)
      })
    })
  }

  const logout = async () => {
  }

  const register = async ({ name, email, password }) => {
    const data = { name, email, password }
    await axios.post('http://localhost:8080/api/register', data).then(response => {
      localStorage.setItem('token', response.data.token)
    }).catch((error) => {
      throw new Error(error.response.data.reason)
    })
  }

  return {
    register,
    login,
    logout
  }
}
