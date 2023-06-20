import axios from 'axios'

export default function useApi () {
  const listExpense = async () => {
    let data = null
    await axios.get('http://localhost:8080/sanctum/csrf-cookie').then(async () => {
      await axios.get('http://localhost:8080/api/expenses').then(response => {
        data = response.data.data
      }).catch(function (error) {
        throw new Error(error.message)
      })
    })

    return data
  }
  const createExpense = async ({ description, value, expense_date }) => {
    const data = { description, value, expense_date }
    await axios.post('http://localhost:8080/api/expenses', data).then(() => {
    }).catch((error) => {
      throw new Error(error.message)
    })
  }
  const getExpenseById = async (id) => {
    let data = null
    await axios.get('http://localhost:8080/sanctum/csrf-cookie').then(async () => {
      await axios.get('http://localhost:8080/api/expenses/' + id).then(response => {
        data = response.data.data
      }).catch(function (error) {
        throw new Error(error.message)
      })
    })

    return data
  }

  const updateExpense = async ({ id, description, value, expense_date }) => {
    const data = { description, value, expense_date }
    await axios.patch('http://localhost:8080/api/expenses/' + id, data).then(() => {
    }).catch((error) => {
      throw new Error(error.message)
    })
  }
  const removeExpense = async (id) => {
    console.log(id)
    await axios.delete('http://localhost:8080/api/expenses/' + id).then(() => {
    }).catch(function (error) {
      throw new Error(error.message)
    })
  }

  return {
    listExpense,
    createExpense,
    getExpenseById,
    updateExpense,
    removeExpense
  }
}
