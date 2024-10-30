<style>
    .slug-license {
        -webkit-font-smoothing: subpixel-antialiased;
        padding: 0;
        margin: 0;
        font-family: inherit;
        font-size: inherit;
        background: greenyellow;
        border: 1px solid #EB5757;
        box-sizing: border-box;
        border-radius: 16px;
        height: 54px;
        color: #EB5757;
        font-weight: 700;
        width: 150px;
        cursor: pointer;

    }

    #license {
        display: none;
    }

    .text-sm {
        font-size: small;
    }

    .w3-modal-content {
        border-radius: 16px;
        width: fit-content !important;
    }

    .w3-modal {
        padding-top: 20% !important;
    }

    .btn-modal {
        cursor: pointer;
        font-size: 15px;
        line-height: 1.5;
        -webkit-font-smoothing: subpixel-antialiased;
        font-family: 'Manrope', sans-serif;
        padding: 0;
        margin: 0;
        box-sizing: inherit;
        outline: 0;
        width: 195px;
        height: 54px;
        background: linear-gradient(0deg, #7668FB, #7668FB);
        box-shadow: 0px 11px 28px -3px rgba(118, 104, 251, 0.32);
        border-radius: 16px;
        /* display: flex;
        align-items: center;
        justify-content: space-evenly; */
        color: white;
        margin-top: 24px;
        margin-bottom: 24px;
        border: 1px solid #7668FB;
    }

    .btn-no {
        cursor: pointer;
        font-size: 15px;
        line-height: 1.5;
        -webkit-font-smoothing: subpixel-antialiased;
        font-family: 'Manrope', sans-serif;
        padding: 0;
        margin: 0;
        box-sizing: inherit;
        outline: 0;
        width: 195px;
        height: 54px;
        background: rgba(118, 104, 251, 0.08);
        box-shadow: 0px 11px 28px -3px rgba(118, 104, 251, 0.32);
        border-radius: 16px;
        /* display: flex;
        align-items: center;
        justify-content: space-evenly; */
        color: black;
        margin-top: 24px;
        margin-bottom: 24px;
        border: 1px solid #7668FB;
    }

    .p-4 {
        padding: 24px;
    }

    .modal-footer {
        display: flex;
        justify-content: space-evenly;
    }

    #id01 {
        display: block;
    }
</style>

<script type="module">
    import {
        createApp,
        ref,
        reactive,
        onMounted
    } from 'vue'



    function console_log(par) {
        if (window.location.origin == 'https://wpmock.test') {
            console.log(par)
        }

    }

    const app = createApp({

        setup() {
            const licenses = ref([])
            const license_key = ref('')
            const api = '<?php echo site_url(); ?>' + '/wp-json/mockpress/v1/option/licenses'
            const resp = ref()
            const keys = ref([])
            const values = ref([])
            const aktif = ref('')
            const suspended = ref(false)
            const style_susp = ref({})
            const dialog = reactive({
                type: 'info',
                title: '',
                message: '',
                show: false,
                owner: 'register',
                rmv: {
                    key: '',
                    pack: ''
                }

            })


            const reverseLicense = () => {
                var tmp = []

                for (let i = licenses.value.length - 1; i >= 0; i--) {
                    tmp.push(licenses.value[i])
                }

                return tmp

            }

            const fetchLicense = async () => {

                console_log({
                    api: api
                })

                resp.value = await fetch(api)
                resp.value = await resp.value.json()

                keys.value = Object.keys(resp.value.licenses)
                values.value = Object.values(resp.value.licenses)

                licenses.value = keys.value.map((val, idx) => {
                    return values.value[idx]
                })

                licenses.value = reverseLicense()

                console_log({
                    licenses: licenses.value,
                    keys: keys.value,
                    values: values.value,


                })

            }



            const register = async (key) => {
                let ajax_url = '<?php echo esc_js(admin_url('admin-ajax.php')); ?>'
                let ajax_nonce = '<?php echo esc_js(wp_create_nonce('mockpress_nonce')); ?>'

                let res = await jQuery.ajax({
                    url: ajax_url,
                    type: 'POST',
                    data: {
                        action: 'mockpress_register_template',
                        license: key,
                        type: 'activate',
                        security: ajax_nonce
                    }
                })
                console_log({
                    res: res
                })

                if ((res.code == 200) && (res.ID != null)) {
                    await fetchLicense()
                    license_key.value = '';


                    return true
                } else {

                    return false
                }

            }

            const remove_license = async (dataq) => {
                let ajax_url = '<?php echo esc_js(admin_url('admin-ajax.php')); ?>'
                let ajax_nonce = '<?php echo esc_js(wp_create_nonce('mockpress_nonce')); ?>'
                try {
                    let result = await jQuery.ajax({
                        url: ajax_url,
                        type: 'POST',
                        data: {
                            action: 'mockpress_remove_license',
                            license: dataq.key,
                            pack: dataq.pack,
                            security: ajax_nonce
                        }
                    })

                    if (result.code == 200) {

                        await fetchLicense()
                        // this.rmv.pack = ''
                        // this.rmv.key = ''
                        // this.aksi(false)
                        // this.konfirm('remove-sukses')
                        console_log('sukses remove license')
                        return true
                    } else {
                        // this.aksi(false)
                        // this.konfirm('remove-fail')
                        console_log({
                            msg: 'error remove license',
                            resp: result
                        })
                        return false
                    }

                } catch (err) {
                    console_log(err)
                }

            }




            onMounted(async () => {
                let srv = '<?php echo MOCKPRESS_SERVER; ?>'
                let domain = location.hostname.replaceAll('.', '_')

                aktif.value = 'Aktif selamanya...'
                // console.log({srv,domain})
                fetch(`${srv}/route/lsd/v1/license/status/${domain}`)
                    .then(res => res.json())
                    .then((res) => {

                        if (res.suspended) {
                            aktif.value = 'Suspended...'
                            suspended.value = true
                            style_susp.value = {

                                background: 'rgba(235, 87, 87, 0.06)',
                                border: '1px solid #EB5757',
                                'box-sizing': 'border-box',
                                'border-radius': '16px',
                                height: '54px',
                                color: '#EB5757',
                                'font-weight': '700'
                            }
                        }

                    })


                await fetchLicense()


            })


            const dialogClose = () => {
                dialog.show = false
            }

            const dialogAction = async () => {
                if (dialog.owner == 'register') {
                    if (await register(license_key.value)) {
                        dialogClose()
                        dialogSukses('register')

                    } else {
                        dialogClose()
                        dialogSukses('register-failed')
                    }
                }

                if (dialog.owner == 'remove') {
                    if (await remove_license(dialog.rmv)) {
                        dialogClose()
                        dialogSukses('remove')

                    } else {
                        dialogClose()
                        dialogSukses('remove-failed')
                    }
                }

            }

            const dialogRegister = () => {
                // if (!suspended.value){

                dialog.type = 'action'
                dialog.title = 'Konfirmasi'
                dialog.message = 'Apakah anda sudah yakin dengan input register license key ini?'
                dialog.owner = 'register'
                dialog.show = true
                // } else
                // {
                //     dialog.type = 'info'
                //     dialog.title = 'Gagal'
                //     dialog.message = 'Akun anda tersuspend, Mohon hubungin admin untuk lebih lanjut..'
                //     dialog.owner = 'register-failed'
                //     dialog.show = true
                // }

            }

            const dialogRemoveLicense = (key, pack) => {
                dialog.type = 'action'
                dialog.title = 'Konfirmasi'
                dialog.message = 'Apakah anda sudah yakin akan menghapus license key ini?'
                dialog.owner = 'remove'
                dialog.rmv = {
                    key: key,
                    pack: pack
                }
                dialog.show = true

            }

            const dialogSukses = (owner) => {
                if (owner == 'register') {
                    dialog.type = 'info'
                    dialog.title = 'Sukses'
                    dialog.message = 'Selamat anda telah berhasil register license'
                    dialog.owner = 'register'
                    dialog.show = true
                    // license_key.value = ''
                }
                if (owner == 'register-failed') {
                    dialog.type = 'info'
                    dialog.title = 'Gagal'
                    dialog.message = 'Maaf register telah gagal, silakan ulangi lagi / hubungi admin mockpress..'
                    dialog.owner = 'register-failed'
                    dialog.show = true
                }

                if (owner == 'remove') {
                    dialog.type = 'info'
                    dialog.title = 'Sukses'
                    dialog.message = 'Selamat anda telah berhasil menghapus license'
                    dialog.owner = 'remove'
                    dialog.show = true
                    // license_key.value = ''
                }
                if (owner == 'remove-failed') {
                    dialog.type = 'info'
                    dialog.title = 'Gagal'
                    dialog.message = 'Maaf menghapus license telah gagal, silakan ulangi lagi / hubungi admin mockpress..'
                    dialog.owner = 'register-failed'
                    dialog.show = true
                }

            }



            return {
                licenses,
                license_key,
                register,
                remove_license,
                dialog,
                dialogClose,
                dialogAction,
                dialogRegister,
                dialogRemoveLicense,
                aktif,
                suspended,
                style_susp
            }
        }



    })
    // app.component('Dialog', Dialog())
    app.mount('#license')
</script>


<div id="license" class="tab">

    <!-- <div v-if="showInfo" v-scope="Dialog({type:'info',title:''})"></div> -->


    <div v-if="!suspended" class="container container5">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="text">
                        <h2>Dimana saya menemukan lisensi saya?</h2>
                        <ul>
                            <li>Masuk ke member area SociaBuzz atau klik <a href="https://sociabuzz.com/shop/login/">disini</a></li>
                            <li>Klik “Akses” pada produk yang kamu beli</li>
                            <li>Salin kode Lisensi & Pastekan disini →</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">

                <div class="input-box">
                    <label for="">Input your license</label>
                    <input type="text" class="form-input" id="license-donation" placeholder="XXXXXXXXXXXXXXXXXXX" v-model="license_key">
                </div>
                <div class="btn">
                    <button @click="dialogRegister()" class="button mp-register-license" data-action="activate">Register <img src="<?php echo MOCKPRESS_URL . 'admin/assets/img/icon-license.svg'; ?>"></button>
                </div>
            </div>
        </div>
    </div>

    <?php //else :
    ?>

    <div class="container container8">



        <div class="title">
            <h2>Connected License</h2>
        </div>
        <!-- Free -->
        <!-- <div class="row" style="height:150px;">
            <div class="col-md-12">
                <div class="group">
                    <div class="profile">
                        <img src="<?php //echo MOCKPRESS_URL . 'admin/assets/img/profile.png';
                                    ?>">
                        <div class="name">
                            <p>Free - Connected</p>

                        </div>
                    </div>


                </div>

            </div>
        </div> -->
        <!-- Free -->

        <!-- content -->
        <div v-if="licenses">
            <div v-for="lic in licenses" class="row">
                <div class="col-md-12">
                    <div class="group">
                        <div class="profile">
                            <img src="<?php echo MOCKPRESS_URL . 'admin/assets/img/profile.png'; ?>">
                            <div class="name">
                                <p>{{lic.title}} - Connected</p>
                                <h3>{{lic.email}}</h3>
                                <div class="text-sm">{{lic.key}}</div>

                            </div>
                        </div>

                        <div v-if="!suspended" class="btn">
                            <button style="cursor:pointer;" @click="dialogRemoveLicense(lic.key,lic.pack)" class="mp-remove-license">Remove License</button>
                        </div>

                    </div>
                    <div class="group2" style="margin:10px auto">
                        <div class="flex">
                            <!-- <img src="<?php echo MOCKPRESS_URL . 'admin/assets/img/Logo.svg'; ?>"> -->
                            <!-- <div class="line"></div> -->
                            <button :style="style_susp">{{aktif}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content -->
    </div>
    <?php //endif;
    ?>

    <div v-if="dialog.show" id="id01" class="w3-modal">
        <div class="w3-modal-content w3-animate-top w3-card-4">
            <header class="w3-container" style="background-color:#8d85e2;border-top-left-radius:16px;border-top-right-radius:16px">

                <h2 style="color:white">{{dialog.title}}</h2>

            </header>
            <div class="w3-container">
                <h3 class="p-4">{{dialog.message}}</h2>
            </div>
            <footer class="w3-container w3-margin-bottom modal-footer">
                <button v-if="dialog.type == 'info'" @click="dialogClose()" class="btn-modal">Oke</button>
                <button v-if="dialog.type == 'action'" @click="dialogAction()" class="btn-modal">Ya</button>
                <button v-if="dialog.type == 'action'" @click="dialogClose()" class="btn-no">Tidak</button>
            </footer>
        </div>
    </div>
</div>