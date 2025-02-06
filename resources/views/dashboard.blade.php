@extends('layouts.app')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen flex flex-wrap gap-6 justify-center">

        <!-- Sales Statistics -->
        <div class="bg-gray-900 text-white rounded-lg p-6 w-80 shadow-lg">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold">Sales Statistics</h2>
                <select class="bg-gray-700 text-white text-sm rounded p-1">
                    <option>Monthly</option>
                    <option>Yearly</option>
                </select>
            </div>
            <p class="text-sm text-gray-400">Updated 1 day ago</p>
            <div class="mt-4">
                <p class="text-3xl font-bold">2,025</p>
                <span class="text-green-400 text-sm">↑ Visitors</span>
            </div>
            <div class="flex mt-4 space-x-2">
                <div class="w-1/2 h-16 bg-purple-400 rounded-lg"></div>
                <div class="w-1/2 h-16 bg-green-400 rounded-lg"></div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-lg p-6 w-80 shadow-lg">
            <h2 class="text-lg font-semibold">Recent Transactions</h2>
            <div class="flex items-center mt-4 space-x-3">
                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                    💱
                </div>
                <div>
                    <p class="text-sm font-semibold">Sell Currency</p>
                    <p class="text-gray-500 text-sm">12.53 ETH / BTC</p>
                </div>
            </div>
        </div>

        <!-- Current Balance -->
        <div class="bg-green-100 rounded-lg p-6 w-80 shadow-lg">
            <h2 class="text-lg font-semibold">Current Balance</h2>
            <div class="mt-4 flex flex-col items-center">
                <div class="relative w-32 h-32">
                    <svg class="absolute top-0 left-0" width="100%" height="100%" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" stroke-width="10" stroke="#ddd" fill="none"></circle>
                        <circle cx="50" cy="50" r="40" stroke-width="10" stroke="black" fill="none"
                            stroke-dasharray="251.2" stroke-dashoffset="210"></circle>
                    </svg>
                    <p class="absolute inset-0 flex items-center justify-center text-2xl font-bold">$15,368</p>
                </div>
                <p class="text-sm text-gray-600">Avg Score: 18,324</p>
            </div>
        </div>

        <!-- Market Forecast -->
        <div class="bg-white rounded-lg p-6 w-80 shadow-lg">
            <h2 class="text-lg font-semibold">Market Forecast</h2>
            <div class="mt-4 space-y-4">
                <div class="text-sm">
                    <p class="font-semibold">2023</p>
                    <p class="text-gray-500">Explosive growth of DeFi</p>
                </div>
                <div class="text-sm">
                    <p class="font-semibold">2024</p>
                    <p class="text-gray-500">Mainstream adoption of CBDCs</p>
                </div>
                <div class="text-sm">
                    <p class="font-semibold">2025</p>
                    <p class="text-gray-500">1 BTC reaches $500K</p>
                </div>
                <div class="text-sm">
                    <p class="font-semibold">2027</p>
                    <p class="text-gray-500">Widespread retail use</p>
                </div>
            </div>
        </div>

        <!-- BTC Price -->
        <div class="bg-green-200 rounded-lg p-6 w-80 shadow-lg">
            <h2 class="text-lg font-semibold">BTC Price</h2>
            <p class="text-3xl font-bold text-gray-900">$21,105</p>
            <p class="text-green-600">+28.21%</p>
        </div>

        <!-- Market Cap Forecast -->
        <div class="bg-purple-200 rounded-lg p-6 w-80 shadow-lg">
            <h2 class="text-lg font-semibold">Market Cap Forecast</h2>
            <p class="text-3xl font-bold text-gray-900">$1.3 Trillion</p>
            <div class="h-16 bg-purple-400 mt-4 rounded-lg"></div>
        </div>
    </div>
@endsection
