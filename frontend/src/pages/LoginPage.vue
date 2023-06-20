<template>
  <q-page padding>
    <q-form class="row justify-center" @submit.prevent="handleLogin">
      <p class="col-12 text-h5 text-center"> Login</p>
      <div class="col-md-4 col-sm-6 col-xs-10 q-gutter-y-md">
        <q-input
          label="Email"
          v-model="form.email"
          lazy-rules
          :rules="[val => (val && val.length > 0 ) || 'Email is required']"
          type="email"
        />

        <q-input
          label="Password"
          v-model="form.password"
          lazy-rules
          :rules="[val => (val && val.length > 0 ) || 'Password is required']"
          type="password"
        />

        <q-btn
          label="Login"
          color="primary"
          class="full-width"
          outline
          rounded
          type="submit"
        />

        <q-btn
          label="Register"
          color="primary"
          class="full-width"
          flat
          to="/register"
        />
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { defineComponent, ref } from 'vue'
import useAuthUser from 'src/helpers/UseAuthUser'
import useNotify from 'src/helpers/UseNotify'
import { useRouter } from 'vue-router'

export default defineComponent({
  name: 'LoginPage',

  setup () {
    const router = useRouter()
    const { login } = useAuthUser()
    const { notifyError, notifySucess } = useNotify()

    const form = ref({
      email: '',
      password: ''
    })
    const handleLogin = async () => {
      try {
        await login(form.value)
        notifySucess('Login Sucess!')
        router.push({ name: 'index' })
      } catch (error) {
        notifyError(error.message)
      }
    }
    return {
      form,
      handleLogin
    }
  }
})
</script>
