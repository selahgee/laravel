

<?php $__env->startSection('title'); ?>

Profile
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="content">
        
    <div class="">
        <div class="row">
            <div class="col-md-3">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img style="width: 50px;" class="profile-user-img img-fluid img-circle" src="<?php echo e(asset('images/avatar.jpg')); ?>">


                        </div>

                        <h3 class="profile-username text-center" style="text-transform: uppercase"><?php echo e(auth()->user()->name); ?> </h3>
                        
                        <p class="text-muted text-center" style="text-transform: uppercase"><?php echo e(auth()->user()->email); ?></p>
                        <p class="text-muted text-center" style="text-transform: uppercase"><?php echo e(auth()->user()->phone); ?></p>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div>

                            <div>
                                <form class="form-horizontal" method="POST" action="<?php echo e(route('users.update', ['user' => $user->id])); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name"><strong>Name:</strong></label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user->name); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email"><strong>Email:</strong></label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="passport"><strong>ID/Passport:</strong></label>
                                                <input type="text" class="form-control" id="passport" name="passport" value="<?php echo e($user->passport); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone"><strong>Phone:</strong></label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e($user->phone); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="age"><strong>Age:</strong></label>
                                                <input type="text" class="form-control" id="age" name="age" value="<?php echo e($user->age); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="allergies"><strong>allergies:</strong></label>
                                                <input type="text" class="form-control" id="allergies" name="allergies" value="<?php echo e($user->allergies); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="disabilities"><strong>disabilities:</strong></label>
                                                <input type="text" class="form-control" id="disabilities" name="disabilities" value="<?php echo e($user->disabilities); ?>">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="button">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/profile.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/users/show.blade.php ENDPATH**/ ?>