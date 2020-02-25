<?php
namespace App\Form;

trait FormTrait
{
    /**
     * @return self|mixed return model itself if has errors, otherwise returns handled's result.
     * @throws \Throwable rethrows exception if no error specified.
     */
    public function handle()
    {
        try {
            if (!$this->validate()) {
                return $this;
            }

            $data = $this->handleInternal();
            return $data;
        } catch (\Throwable $e) {
            if ($this->hasErrors()) {
                return $this;
            }

            throw $e;
        }
    }
}
