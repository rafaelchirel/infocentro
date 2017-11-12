<?php 
namespace Infocentro\Traits;

use Infocentro\Imagen_usu_per;
use Infocentro\Personal;
use Intervention\Image\Image;

trait ImagenUsuPerTrait
{
    public function ImagenStoreTrait($cargo, $img, $id, $genero)
    {
        $imagen_per = new Imagen_usu_per();//llamo a mi modelo imagen

        if ($img) {
            if ($cargo == 1) {
                $name = 'personal_' . time() . '.' . $img->getClientOriginalExtension();
            } else {
                $name = 'usuario_' . time() . '.' . $img->getClientOriginalExtension();
            }
            
            $path = public_path('img/usu_per/' . $name);

            //cambiando dimension imagen paquete intervention/image
            \Image::make($img)->resize(100, 100)->save($path);

            $imagen_per->url = $name;
            $imagen_per->usu_per_id = $id;
            $imagen_per->save();

        } else {
            if ($genero == 'M') {
                $imagen_per->url = 'M.jpg';
                $imagen_per->usu_per_id = $id;
                $imagen_per->save();
            } else {
                $imagen_per->url = 'F.jpg';
                $imagen_per->usu_per_id = $id;
                $imagen_per->save();
            }
        }
    }

    public function ImagenUpdateTrait($cargo, $img, $id, $cond_img, $genero){

        $imagen_per = Imagen_usu_per::findOrFail($id);//instancio con mi modelo

        if ($img) {

            if ($cargo == 1) {
                $name = 'personal_' . time() . '.' . $img->getClientOriginalExtension();
            } else {
                $name = 'usuario_' . time() . '.' . $img->getClientOriginalExtension();
            }

            $path = public_path('img/usu_per/' . $name);

            //cambiando dimension imagen paquete intervention/image
            \Image::make($img)->resize(100, 100)->save($path);

            //eliminar imagen siempre y cuando sea diferente de M.jpg y F.jpj
            if ($imagen_per->url != "M.jpg" && $imagen_per->url != "F.jpg") {
                $path = public_path() . '/img/usu_per/';
                \File::delete($path . $imagen_per->url);
            }

            $imagen_per->url = $name;
            $imagen_per->usu_per_id = $id;
            $imagen_per->update();

        } else {

            if ($img == null && $cond_img == 'M.jpg' || $cond_img == 'F.jpg') {

                if ($genero == 'M') {
                    $imagen_per->url = 'M.jpg';
                    $imagen_per->usu_per_id = $id;
                    $imagen_per->update();
                } else {
                    $imagen_per->url = 'F.jpg';
                    $imagen_per->usu_per_id = $id;
                    $imagen_per->update();
                }
            }
        }
    }
}