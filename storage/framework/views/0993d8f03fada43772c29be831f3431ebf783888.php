<?php $__env->startSection('content'); ?>
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4><?php echo e(trans('file.add_product')); ?></h4>
                        </div>
                        <form id="product-form" method="POST" action="<?php echo e(url('products/' . $product->id)); ?>">
                        <div class="card-body">
                            <p class="italic">
                                <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
                            </p>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('put'); ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__('file.Tag Type Code')); ?> *</strong> </label>
                                                    <select name="tag_type_id" class="form-control" id="tag_type_id">
                                                        <option value=""><?php echo e(__('file.Select')); ?></option>
                                                        <?php $__currentLoopData = $tagType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($item->id); ?>"
                                                                style="color: <?php echo e($item->color); ?>

                                                                 font-weight: bold"
                                                                <?php if($item->id == @$product->tag_type_id): ?> selected <?php endif; ?>>
                                                                <?php echo e($item->code); ?> - <?php echo e($item->color); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <?php $__errorArgs = ['tag_type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(trans('file.Product Code')); ?> *</strong> </label>
                                                    <div class="input-group">
                                                        <input type="text" name="code" class="form-control"
                                                            id="code" aria-describedby="code"
                                                            value="<?php echo e($product->code); ?>">
                                                        <div class="input-group-append">
                                                            <button id="genbutton" type="button"
                                                                class="btn btn-sm btn-default"
                                                                title="<?php echo e(trans('file.Generate')); ?>">
                                                                <i class="fa fa-refresh"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <span class="validation-msg" id="code-error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__('file.Gramasi Code')); ?> *</strong></label>
                                                    <select name="gramasi_id" class="form-control" id="input-kd-gramasi">
                                                        <option value=""><?php echo e(__('file.Select')); ?>

                                                        </option>
                                                        <?php $__currentLoopData = $gramasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($item->id); ?>"
                                                                <?php if($item->id == @$product->gramasi_id): ?> selected <?php endif; ?>>
                                                                <?php echo e($item->code); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <?php $__errorArgs = ['gramasi_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__('file.Discount')); ?> *</strong> </label>
                                                    <input type="number" class="form-control" name="discount"
                                                        id="input-diskon" value="<?php echo e($product->discount); ?>">
                                                    <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Miligram</label>
                                                    <input type="number" class="form-control" name="mg" class="mg"
                                                        id="input-mg" value="<?php echo e($product->mg); ?>">
                                                    <?php $__errorArgs = ['mg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(trans('file.Product Price')); ?> *</strong> </label>
                                                    <input type="text" id="price" name="price" class="form-control"
                                                        step="any" value="<?php echo e($product->price); ?>">
                                                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <span class="validation-msg"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__('file.Product Property Code')); ?>*</strong> </label>
                                                    <select name="product_property_id" class="form-control"
                                                        id="input-kd-sifat">
                                                        <option value=""><?php echo e(__('file.Select')); ?>

                                                        </option>
                                                        <?php $__currentLoopData = $productProperty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($item->id); ?>"
                                                                <?php if($item->id == @$product->product_property_id): ?> selected <?php endif; ?>>
                                                                <?php echo e($item->code); ?> -
                                                                <?php echo e($item->description); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <?php $__errorArgs = ['product_property_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6"></div>

                                            <div class="col-md-10">
                                                <div class="row" id="product-preview"
                                                    style="background-color: <?php echo e(@$product->tagType->color); ?>">
                                                    <div class="col-md-6">
                                                        <div class="card h-100 bg-transparent">
                                                            <div class="card-body">
                                                                <div class="row font-weight-bold">
                                                                    <div class="col-md-6 mb-3">
                                                                        <h1 id="prev-kd-gramasi"></h1>
                                                                    </div>

                                                                    <div class="col-md-6 text-right mb-3">
                                                                        <h1 id="prev-diskon"></h1>
                                                                    </div>

                                                                    <div class="col-md-12 text-center">
                                                                        <h1 class="d-inline display-4" id="prev-mg"></h1>
                                                                        <span class="align-top" id="prev-gramasi"></span>
                                                                    </div>

                                                                    <div class="col-md-12 text-right">
                                                                        <h1 id="prev-kd-sifat"></h1>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 border">
                                                        <div
                                                            class="h-100 d-flex align-items-center justify-content-center">
                                                            <div class="text-center" id="prev-qrcode">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" id="submit-btn" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <script type="text/javascript">
        $('[data-toggle="tooltip"]').tooltip()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        const produk = JSON.parse('<?php echo $product; ?>')

        $("#prev-kd-sifat").text(produk.product_property.code)
        $("#prev-kd-gramasi").text(produk.gramasi.code)
        $("#prev-gramasi").text(produk.gramasi.gramasi)
        $("#prev-diskon").text(produk.discount)
        $("#prev-mg").text(produk.mg)

        generateQRCode(produk.code, "prev-qrcode")

        // handle aksi generate genereate code 
        $('#genbutton').on("click", function() {
            $.get("<?php echo url('products/gencode'); ?>", function(data) {
                $("input[name='code']").val(data)
                generateQRCode(data, "prev-qrcode")
            })

        })

        // Fungsi untuk menghasilkan QR code
        function generateQRCode(data, elementId) {
            document.getElementById(elementId).innerHTML = ""
            var qrcode = new QRCode(document.getElementById(elementId), {
                text: data,
                width: 200,
                height: 200
            })
        }

        $(window).keydown(function(e) {
            if (e.which == 13) {
                var $targ = $(e.target)
                if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
                    var focusNext = false
                    $(this).find(":input:visible:not([disabled],[readonly]), a").each(function() {
                        if (this === e.target) {
                            focusNext = true
                        } else if (focusNext) {
                            $(this).focus()
                            return false
                        }
                    })
                    return false
                }
            }
        })

        var rupiah = document.getElementById('price')

        rupiah.addEventListener('keyup', function(e) {
            rupiah.value = formatRupiah(this.value, 'input')
        })

        function formatRupiah(angka, type) {
            var number_string = ''
            var split = ''
            var sisa = ''
            var rupiah = ''
            var ribuan = ''

            if (angka.toString().includes("-")) {
                var reverse = angka.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g)
                ribuan = ribuan.join('.').split('').reverse().join('')
                return "-" + ribuan
            }

            if (type == 'input') {
                number_string = angka.replace(/[^,\d]/g, '').toString(), split = number_string.split(',')
                sisa = split[0].length % 3
                rupiah = split[0].substr(0, sisa)
                ribuan = split[0].substr(sisa).match(/\d{3}/gi)
            } else {
                number_string = angka.toString()
                split = number_string.split(',')
                sisa = split[0].length % 3
                rupiah = split[0].substr(0, sisa)
                ribuan = split[0].substr(sisa).match(/\d{3}/gi)
            }

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : ''
                rupiah += separator + ribuan.join('.')
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
            // return prefix == undefined || ? rupiah : (rupiah ? '' + rupiah : '')
            return (rupiah)

        }

        const getGramasi = (id_gramasi) => {
            const gramasis = JSON.parse('<?php echo $gramasi; ?>')
            const selectedGramasi = gramasis.find(({
                id
            }) => id === id_gramasi)
            return selectedGramasi
        }

        const getKdSifat = (id_kd_sifat) => {
            const properties = JSON.parse('<?php echo $productProperty; ?>')
            const selectedProerties = properties.find(({
                id
            }) => id === id_kd_sifat)
            return selectedProerties.code
        }

        $("#tag_type_id").change(function(e) {
            e.preventDefault()

            var selectedText = $(this).find('option:selected').text()

            var color = selectedText.split('-')[1]

            $("#product-preview").css("background-color", color)

        })


        $("#input-kd-gramasi").change(function(e) {
            e.preventDefault()

            id = parseInt(e.target.value)
            const gramasi = getGramasi(id)
            $("#prev-gramasi").text(gramasi.gramasi)

            $("#prev-kd-gramasi").text(gramasi.code)

        })


        $("#input-kd-sifat").change(function(e) {
            e.preventDefault()

            id = parseInt(e.target.value)
            const property = getKdSifat(id)
            $("#prev-kd-sifat").text(property)

        })


        $("#input-mg").bind("input", function(e) {
            e.preventDefault()

            const mg = e.target.value
            $("#prev-mg").text(mg)

        })


        $("#input-diskon").bind("input", function(e) {
            e.preventDefault()

            const diskon = e.target.value
            $("#prev-diskon").text(diskon)

        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/product/edit.blade.php ENDPATH**/ ?>