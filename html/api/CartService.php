<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/SessionService.php';

    class CartService {

        private $cart;

        private $sessionService;

        private const CART_SESSION_KEY = 'cart';


        public function addToCart(int $id): void {
            if ($this->cartExists())
                $this->rewriteCart($id);

            else
                $this->createCartWithItem($id);
        }

        public function itemQuantity($id): int {
            return $this->cart[$id];
        }

        public function cartNotEmpty(): bool {
            if ($items = $this->getItemsInCart())
                return count($items) > 0;

            return false;
        }

        public function getItemsInCart() {
            if ($this->cartExists())
                return array_keys($this->cart);

            return null;
        }


        private function appendItem($id) {
            $count = &$this->cart[$id];
            $count += 1;
        }

        private function rewriteCart($id) {
            $this->createCartWithItem($id);
        }

        private function createCartWithItem($id) {
            $this->sessionService->setSessionValue(self::CART_SESSION_KEY, [$id => 1]);
            $this->cart = &$this->sessionService->getSessionValueReference(self::CART_SESSION_KEY);
        }

        private function cartExists(): bool {
            return !is_null($this->cart);
        }

        private function cartExistsSession(): bool {
            return $this->sessionService->valueExists(self::CART_SESSION_KEY);
        }


        public function __construct(SessionService $sessionService) {
            $this->sessionService = $sessionService;

            if ($this->cartExistsSession()) {
                $this->cart = &$sessionService->getSessionValueReference(self::CART_SESSION_KEY);
            }
        }
    }
